<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'total_credit_hours',
        'department_id'
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

}
