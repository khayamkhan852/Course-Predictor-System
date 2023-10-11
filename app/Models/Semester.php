<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


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

    public function results(): HasMany
    {
        return $this->hasMany(Result::class, 'semester_id');
    }

    public function registrationSemesters(): HasMany
    {
        return $this->hasMany(RegistrationSemester::class, 'semester_id');
    }

}
