<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 
        'bio', 
        'experience_years', 
        'consultation_fee', 
        'clinic_name', 
        'clinic_address', 
        'latitude', 
        'longitude', 
        'gender', 
        'is_verified'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'experience_years' => 'integer',
        'consultation_fee' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function specialties(): BelongsToMany
    {
        return $this->belongsToMany(Specialty::class, 'doctor_specialty');
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'doctor_language');
    }

    public function insurancePlans(): BelongsToMany
    {
        return $this->belongsToMany(InsurancePlan::class, 'doctor_insurance_plans');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(DoctorEducation::class);
    }

    public function certifications(): HasMany
    {
        return $this->hasMany(DoctorCertification::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(DoctorSchedule::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
