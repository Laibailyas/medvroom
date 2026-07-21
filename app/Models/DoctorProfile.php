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
        'price_initial',
        'price_followup',
        'profile_photo_path',
        'clinic_name',
        'clinic_address',
        'virtual_only',
        'practice_city',
        'practice_state',
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
        'license_number',
        'license_expiration_date',
        'npi_number',
        'npi_data',
        'license_states',
        'dea_number',
        'telehealth_available',
        'visit_types',
        'services_offered',
        'insurances_accepted',
        'document_license_path',
        'document_id_path',
        'document_malpractice_path',
        'onboarding_step',
        'application_submitted_at',
        'agreed_provider_agreement',
        'agreed_baa',
        'agreed_license_validity',
        'agreed_payment_authorization',
        'baa_accepted_at',
        'baa_accepted_ip',
        // Admin
        'admin_note',
        'verification_decided_at',
        'needs_info',
        'info_requested_at',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'virtual_only' => 'boolean',
        'experience_years' => 'integer',
        'consultation_fee' => 'decimal:2',
        'price_initial' => 'decimal:2',
        'price_followup' => 'decimal:2',
        'npi_data' => 'array',
        'license_states' => 'array',
        'visit_types' => 'array',
        'services_offered' => 'array',
        'insurances_accepted' => 'array',
        'telehealth_available' => 'boolean',
        'agreed_provider_agreement' => 'boolean',
        'agreed_baa' => 'boolean',
        'agreed_license_validity' => 'boolean',
        'agreed_payment_authorization' => 'boolean',
        'baa_accepted_at' => 'datetime',
        'application_submitted_at' => 'datetime',
        'verification_decided_at' => 'datetime',
        'needs_info' => 'boolean',
        'info_requested_at' => 'datetime',
        'date_of_birth' => 'date',
        'license_expiration_date' => 'date',
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
            // FIX: only attempt to build slots if the schedule row actually has
            // both a start_time and end_time set — prevents the "Not enough data
            // available to satisfy format" crash when a doctor has an
            // incomplete/blank schedule row.
            if ($daySchedule && $daySchedule->start_time && $daySchedule->end_time) {
                $daySlots = [];
                // Determine doctor's working hours for this date in doctor's timezone
                $startTimeDoctor = $this->parseScheduleTime($daySchedule->start_time, $doctorTimezone)
                    ->setDate($currentDate->year, $currentDate->month, $currentDate->day);
                $endTimeDoctor = $this->parseScheduleTime($daySchedule->end_time, $doctorTimezone)
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

    /**
     * Safely parse a schedule time value (string 'H:i:s', 'H:i', or an
     * already-cast Carbon/DateTime instance) into a Carbon instance in the
     * given timezone. Falls back to midnight instead of crashing if the
     * value is in an unexpected format.
     */
    protected function parseScheduleTime($value, string $timezone): Carbon
    {
        // If it's already a Carbon/DateTime instance (e.g. if a cast is added later)
        if ($value instanceof \DateTimeInterface) {
            return Carbon::instance($value)->setTimezone($timezone);
        }

        $value = trim((string) $value);

        // Handle "09:00" (missing seconds) by appending ":00"
        if (preg_match('/^\d{1,2}:\d{2}$/', $value)) {
            $value .= ':00';
        }

        // If it still doesn't match H:i:s, fall back to midnight rather than crashing
        if (! preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $value)) {
            return Carbon::createFromTime(0, 0, 0, $timezone);
        }

        return Carbon::createFromFormat('H:i:s', $value, $timezone);
    }
}