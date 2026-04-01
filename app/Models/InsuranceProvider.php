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

    public function plans(): HasMany
    {
        return $this->hasMany(InsurancePlan::class, 'provider_id');
    }
}
