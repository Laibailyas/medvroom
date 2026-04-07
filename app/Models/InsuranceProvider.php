<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InsuranceProvider extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'is_featured'];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function getLogoUrlAttribute(): string
    {
        if (str_starts_with($this->logo, 'http')) {
            return $this->logo;
        }

        return asset('storage/'.$this->logo);
    }

    public function plans(): HasMany
    {
        return $this->hasMany(InsurancePlan::class, 'provider_id');
    }
}
