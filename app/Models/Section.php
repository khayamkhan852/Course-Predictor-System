<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Section extends Model
{
    protected $fillable = [
        'name'
    ];

    final public function courseInstructors(): HasMany
    {
        return $this->hasMany(CourseInstructor::class, 'section_id');
    }
}
