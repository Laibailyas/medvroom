<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\Auth\ResetPassword as ResetPasswordNotification;
use App\Notifications\Auth\VerifyEmail as VerifyEmailNotification;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['first_name', 'middle_name', 'last_name', 'name', 'email', 'mobile', 'password', 'role', 'provider', 'provider_id', 'provider_token', 'mobile_verification_code', 'mobile_verification_expires_at', 'mobile_verified_at'])]
#[Hidden(['password', 'remember_token', 'provider_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function (User $user) {
            if ($user->isDirty(['first_name', 'middle_name', 'last_name'])) {
                $user->name = collect([$user->first_name, $user->middle_name, $user->last_name])
                    ->filter()
                    ->implode(' ');
            }
        });
    }

    /**
     * Get the user's full name.
     */
    public function getNameAttribute($value): string
    {
        if (! empty($this->first_name) || ! empty($this->last_name)) {
            return collect([$this->first_name, $this->middle_name, $this->last_name])
                ->filter()
                ->implode(' ');
        }

        return $value ?? '';
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Role Constants
     */
    public const ROLE_PATIENT = 'patient';

    public const ROLE_DOCTOR = 'doctor';

    public const ROLE_ADMIN = 'admin';

    /**
     * Role Helpers
     */
    public function isDoctor(): bool
    {
        return $this->role === self::ROLE_DOCTOR;
    }

    public function isPatient(): bool
    {
        return $this->role === self::ROLE_PATIENT;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Profiles
     */
    public function doctorProfile(): HasOne
    {
        return $this->hasOne(DoctorProfile::class);
    }

    public function patientProfile(): HasOne
    {
        return $this->hasOne(PatientProfile::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mobile_verified_at' => 'datetime',
            'mobile_verification_expires_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
        ];
    }
}
