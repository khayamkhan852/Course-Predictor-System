<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class CourseInstructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id', // from users, instructor id foreign key
        'course_id', // from users, course id foreign key
        'section_id', // from users, section id foreign key
    ];

    final public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id')->withDefault([
            'name' => 'Not Provided',
        ]);
    }

    final public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id')->withDefault([
            'title' => 'Not Provided',
        ]);
    }

    final public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id')->withDefault([
            'name' => 'Not Provided',
        ]);
    }
}
