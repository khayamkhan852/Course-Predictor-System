<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CourseRegistration extends Model
{

    protected $fillable = [
        'student_id',
        'created_by',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrationSemesters(): HasMany
    {
        return $this->hasMany(RegistrationSemester::class, 'registration_id');
    }

    public function registrationSemesterCourses(): HasMany
    {
        return $this->hasMany(RSemesterCourse::class, 'registration_id');
    }
}
