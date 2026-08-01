<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function doctorProfiles()
    {
        return $this->hasMany(DoctorProfile::class);
    }
}