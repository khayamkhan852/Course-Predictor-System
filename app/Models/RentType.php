<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type','created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}