<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorEducation extends Model
{
    use HasFactory;

    protected $table = 'doctor_educations';

    protected $fillable = ['doctor_profile_id', 'degree', 'institution', 'graduation_year'];

    public function doctorProfile(): BelongsTo
    {
        return $this->belongsTo(DoctorProfile::class);
    }
}
