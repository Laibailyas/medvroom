<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'amount',
        'platform_fee',
        'provider_payout',
        'status',
        'transaction_id',
        'payment_intent_id',
        'payout_status',
        'payment_method',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'provider_payout' => 'decimal:2',
    ];

    /**
     * Calculate fee split based on current system commission.
     */
    public static function calculateSplit(float $totalAmount): array
    {
        $commission = SystemSetting::get('platform_commission', ['percentage' => 15]);
        $percentage = $commission['percentage'] / 100;

        $platformFee = $totalAmount * $percentage;
        $providerPayout = $totalAmount - $platformFee;

        return [
            'platform_fee' => $platformFee,
            'provider_payout' => $providerPayout,
        ];
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}
