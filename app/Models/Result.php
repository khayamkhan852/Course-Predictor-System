<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Result extends Model
{
    protected $fillable = [
        'student_id',
        'semester_id',
        'cgpa',
    ];

    public function resultCourses(): HasMany
    {
        return $this->hasMany(ResultCourse::class, 'result_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
