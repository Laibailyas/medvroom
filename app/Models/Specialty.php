<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon'];

    /**
     * Get the URL for the icon or the emoji itself.
     */
    public function getIconUrlAttribute(): string
    {
        if (empty($this->icon)) {
            return '🩺';
        }

        if (str_starts_with($this->icon, 'specialties/')) {
            return asset('storage/'.$this->icon);
        }

        return $this->icon;
    }

    /**
     * Determine if the icon is an emoji.
     */
    public function getIsEmojiAttribute(): bool
    {
        return ! str_starts_with($this->icon, 'specialties/');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function doctorProfiles(): BelongsToMany
    {
        return $this->belongsToMany(DoctorProfile::class, 'doctor_specialty');
    }

    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class);
    }
}
