<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class RegistrationSemester extends Model
{

    protected $fillable = [
        'registration_id',
        'semester_id',
    ];

    public function courseRegistration(): BelongsTo
    {
        return $this->belongsTo(CourseRegistration::class, 'registration_id');
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function registrationSemesterCourses(): HasMany
    {
        return $this->hasMany(RSemesterCourse::class, 'r_semester_id');
    }
}
