<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PatientProfile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'medical_notes', 'date_of_birth', 'sex', 'extended_gender', 'well_guide_data'];

    protected $casts = [
        'date_of_birth' => 'date',
        'extended_gender' => 'array',
        'well_guide_data' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function insurancePlans(): BelongsToMany
    {
        return $this->belongsToMany(InsurancePlan::class, 'patient_insurance_plans');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
