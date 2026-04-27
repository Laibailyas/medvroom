<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'is_verified',
        'practice_name',
        'practice_specialty',
        'practice_size',
        'phone_number',
        'practice_zip_code',
        'referral_source',
        'timezone',
        // Onboarding
        'provider_type',
        'entity_type',
        'date_of_birth',
        'npi_number',
        'npi_data',
        'license_states',
        'telehealth_available',
        'visit_types',
        'document_license_path',
        'document_id_path',
        'document_malpractice_path',
        'onboarding_step',
        'application_submitted_at',
        'agreed_provider_agreement',
        'agreed_baa',
        'agreed_license_validity',
        // Admin
        'admin_note',
        'verification_decided_at',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'experience_years' => 'integer',
        'consultation_fee' => 'decimal:2',
        'npi_data' => 'array',
        'license_states' => 'array',
        'visit_types' => 'array',
        'telehealth_available' => 'boolean',
        'agreed_provider_agreement' => 'boolean',
        'agreed_baa' => 'boolean',
        'agreed_license_validity' => 'boolean',
        'application_submitted_at' => 'datetime',
        'verification_decided_at' => 'datetime',
        'date_of_birth' => 'date',
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

    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }

    /**
     * Get availability for a given date range, adjusted for user timezone.
     */
    public function getAvailabilityForRange(Carbon $startDate, Carbon $endDate, string $userTimezone = 'UTC'): array
    {
        $doctorTimezone = $this->timezone ?? config('app.timezone');
        $schedules = $this->schedules;

        // Fetch appointments in the range
        $appointments = $this->appointments()
            ->whereBetween('appointment_datetime', [$startDate->copy()->startOfDay()->setTimezone('UTC'), $endDate->copy()->endOfDay()->setTimezone('UTC')])
            ->get();

        $availability = [];
        $currentDate = $startDate->copy()->startOfDay();
        $nowDoctor = Carbon::now($doctorTimezone);

        while ($currentDate <= $endDate) {
            $dayOfWeek = $currentDate->dayOfWeek; // 0 (Sun) - 6 (Sat)
            $daySchedule = $schedules->where('day_of_week', $dayOfWeek)->first();

            $daySlots = null;
            if ($daySchedule) {
                $daySlots = [];
                // Determine doctor's working hours for this date in doctor's timezone
                $startTimeDoctor = Carbon::createFromFormat('H:i:s', $daySchedule->start_time, $doctorTimezone)
                    ->setDate($currentDate->year, $currentDate->month, $currentDate->day);
                $endTimeDoctor = Carbon::createFromFormat('H:i:s', $daySchedule->end_time, $doctorTimezone)
                    ->setDate($currentDate->year, $currentDate->month, $currentDate->day);

                $slotDuration = $daySchedule->slot_duration_minutes ?? 30;

                $currentSlotStart = $startTimeDoctor->copy();
                while ($currentSlotStart->copy()->addMinutes($slotDuration) <= $endTimeDoctor) {
                    // Skip if slot is in the past
                    if ($currentSlotStart->lte($nowDoctor)) {
                        $currentSlotStart->addMinutes($slotDuration);

                        continue;
                    }

                    $slotStartUTC = $currentSlotStart->copy()->setTimezone('UTC');

                    // Check if booked
                    $isBooked = $appointments->contains(function ($appointment) use ($slotStartUTC) {
                        return $appointment->appointment_datetime->equalTo($slotStartUTC);
                    });

                    if (! $isBooked) {
                        $daySlots[] = $currentSlotStart->copy()->setTimezone($userTimezone)->format('H:i');
                    }

                    $currentSlotStart->addMinutes($slotDuration);
                }
            }

            $availability[$currentDate->format('Y-m-d')] = $daySlots;
            $currentDate->addDay();
        }

        return $availability;
    }
}
