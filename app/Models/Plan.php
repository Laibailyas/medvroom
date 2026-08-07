<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'monthly_fee',
        'per_booking_fee',
        'is_promoted_addon',
        'stripe_price_id',
    ];

    protected $casts = [
        'monthly_fee' => 'decimal:2',
        'per_booking_fee' => 'decimal:2',
        'is_promoted_addon' => 'boolean',
    ];

    public function doctorProfiles(): HasMany
    {
        return $this->hasMany(DoctorProfile::class);
    }
}