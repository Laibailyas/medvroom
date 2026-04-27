<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_profile_id',
        'stripe_payout_id',
        'amount',
        'currency',
        'status',
        'arrival_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'arrival_date' => 'datetime',
    ];

    public function doctorProfile()
    {
        return $this->belongsTo(DoctorProfile::class);
    }
}
