<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Course extends Model
{
    protected $fillable = [
        'code',
        'title',
        'credit_hours',
        'course_level', // BS, MS, PhD
        'coordinator_id', // from users, coordinator id foreign key
        'department_id',
        'course_id' // pre requisite course
    ];

    final public function courseInstructors(): HasMany
    {
        return $this->hasMany(CourseInstructor::class, 'course_id');
    }


    final public function pre_requisite_course(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'course_id')->withDefault([
            'code' => 'none',
            'title' => 'none',
            'credit_hours' => '0',
        ]);
    }

    final public function coordinator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'coordinator_id')->withDefault([
            'name' => 'Not Provided',
        ]);
    }

    final public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id')->withDefault([
            'name' => 'Not Provided',
        ]);
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class);
    }

    public function resultCourses(): HasMany
    {
        return $this->hasMany(ResultCourse::class, 'course_id');
    }

}
