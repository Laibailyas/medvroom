<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'doctor_profile_id', 
        'patient_profile_id', 
        'insurance_plan_id', 
        'appointment_datetime', 
        'notes'
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
            'changed_by_id' => $changedById ?? auth()->id(),
        ]);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
