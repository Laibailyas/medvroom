<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InsurancePlan extends Model
{
    use HasFactory;

    protected $fillable = ['provider_id', 'name', 'plan_type'];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(InsuranceProvider::class);
    }

    public function doctorProfiles(): BelongsToMany
    {
        return $this->belongsToMany(DoctorProfile::class, 'doctor_insurance_plans');
    }

    public function patientProfiles(): BelongsToMany
    {
        return $this->belongsToMany(PatientProfile::class, 'patient_insurance_plans');
    }
}
