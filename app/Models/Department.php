<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Department extends Model
{
    protected $fillable = ['name', 'short_name'];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'department_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'department_id');
    }

    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class, 'department_id');
    }



}
