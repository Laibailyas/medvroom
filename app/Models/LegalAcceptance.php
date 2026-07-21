<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LegalAcceptance extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_profile_id',
        'document_slug',
        'version',
        'accepted_at',
        'ip_address',
        'audited_at',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
        'audited_at'  => 'datetime',
    ];

    public function doctorProfile(): BelongsTo
    {
        return $this->belongsTo(DoctorProfile::class);
    }

    /**
     * Record (or update) the acceptance of a given document version by a
     * doctor profile, capturing the full audit trail: version, accepted
     * date/time, provider id (via doctor_profile_id), IP, and a separate
     * audit timestamp.
     */
    public static function record(DoctorProfile $profile, string $slug, string $version, ?string $ip): self
    {
        return static::updateOrCreate(
            [
                'doctor_profile_id' => $profile->id,
                'document_slug'     => $slug,
            ],
            [
                'version'     => $version,
                'accepted_at' => now(),
                'ip_address'  => $ip,
                'audited_at'  => now(),
            ]
        );
    }
}
