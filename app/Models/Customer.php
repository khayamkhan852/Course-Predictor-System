<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Customer extends Model implements HasMedia
{
    use HasFactory; use InteractsWithMedia;

    protected $fillable = ['profile_image','customer_code','first_name','last_name','email','phone','dob','customer_type_id',
    'customer_status_id','country','state','city','zip_code','address','remarks','created_by'];

    public function customerDocuments()
    {
        return $this->hasMany(CustomerDocument::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function customer_type()
    {
        return $this->belongsTo(CustomerType::class, 'customer_type_id');
    }

    public function customer_status()
    {
        return $this->belongsTo(CustomerStatus::class, 'customer_status_id');
    }

}
