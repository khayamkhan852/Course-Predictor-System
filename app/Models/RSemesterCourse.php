<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class RSemesterCourse extends Model
{
    protected $fillable = [
        'registration_id',
        'r_semester_id',
        'course_id'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function registrationSemester(): BelongsTo
    {
        return $this->belongsTo(RegistrationSemester::class, 'r_semester_id');
    }

    public function courseRegistration(): BelongsTo
    {
        return $this->belongsTo(CourseRegistration::class, 'registration_id');
    }
}
