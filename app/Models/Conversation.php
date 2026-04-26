<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'doctor_id', 'last_message_at'];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Check if there is an active appointment between the two users.
     * Active is defined as 'confirmed' or 'reschedule_requested'.
     */
    public function isActive(): bool
    {
        return Appointment::where('doctor_profile_id', function ($query) {
            $query->select('id')->from('doctor_profiles')->where('user_id', $this->doctor_id)->limit(1);
        })
            ->where('patient_profile_id', function ($query) {
                $query->select('id')->from('patient_profiles')->where('user_id', $this->patient_id)->limit(1);
            })
            ->whereHas('statusHistories', function ($query) {
                $query->whereIn('status', ['confirmed', 'reschedule_requested'])
                    ->whereIn('id', function ($sub) {
                        $sub->select(DB::raw('MAX(id)'))
                            ->from('appointment_status_histories')
                            ->groupBy('appointment_id');
                    });
            })
            ->exists();
    }
}
