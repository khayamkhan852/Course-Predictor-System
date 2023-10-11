<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ResultCourse extends Model
{
    protected $fillable = [
        'result_id',
        'course_id',
        'grade',
        'gpa',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function result(): BelongsTo
    {
        return $this->belongsTo(Result::class, 'result_id');
    }
}
