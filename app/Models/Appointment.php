<?php

namespace App\Models;

use App\Events\MessageSent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'doctor_profile_id',
        'patient_profile_id',
        'insurance_plan_id',
        'appointment_datetime',
        'notes',
    ];

    protected $casts = [
        'appointment_datetime' => 'datetime',
    ];

    /**
     * Get the current status from the latest history record.
     */
    public function getStatusAttribute(): ?string
    {
        return $this->latestStatusHistory?->status;
    }

    public function doctorProfile(): BelongsTo
    {
        return $this->belongsTo(DoctorProfile::class);
    }

    public function patientProfile(): BelongsTo
    {
        return $this->belongsTo(PatientProfile::class);
    }

    public function insurancePlan(): BelongsTo
    {
        return $this->belongsTo(InsurancePlan::class);
    }

    /**
     * Status History
     */
    public function statusHistories(): HasMany
    {
        return $this->hasMany(AppointmentStatusHistory::class);
    }

    public function latestStatusHistory(): HasOne
    {
        return $this->hasOne(AppointmentStatusHistory::class)->latestOfMany();
    }

    /**
     * Transition the appointment status and record history.
     */
    public function transitionStatus(string $newStatus, ?string $comment = null, ?int $changedById = null): void
    {
        $this->statusHistories()->create([
            'status' => $newStatus,
            'comment' => $comment,
            'changed_by_id' => $changedById ?? Auth::id(),
        ]);

        try {
            $conversation = Conversation::firstOrCreate([
                'patient_id' => $this->patientProfile->user_id,
                'doctor_id' => $this->doctorProfile->user_id,
            ]);

            $messageText = 'System: Appointment status updated to '.str_replace('_', ' ', $newStatus).'.';
            if ($comment) {
                $messageText .= " Reason/Note: {$comment}";
            }

            $message = $conversation->messages()->create([
                'sender_id' => $changedById ?? Auth::id() ?? $this->patientProfile->user_id,
                'message_body' => $messageText,
                'metadata' => ['is_system' => true, 'status' => $newStatus],
            ]);

            $conversation->update(['last_message_at' => now()]);
            broadcast(new MessageSent($message))->toOthers();
        } catch (\Throwable $e) {
        }
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get the conversation between the doctor and patient users.
     */
    public function conversation(): ?Conversation
    {
        return Conversation::where('patient_id', $this->patientProfile->user_id)
            ->where('doctor_id', $this->doctorProfile->user_id)
            ->first();
    }
}
