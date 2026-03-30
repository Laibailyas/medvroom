<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorCertification extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_profile_id', 
        'name', 
        'issuing_organization', 
        'issue_date', 
        'expiration_date'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiration_date' => 'date',
    ];

    public function doctorProfile(): BelongsTo
    {
        return $this->belongsTo(DoctorProfile::class);
    }
}
