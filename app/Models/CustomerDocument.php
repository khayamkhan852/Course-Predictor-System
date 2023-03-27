<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class CustomerDocument extends Model implements HasMedia
{
    use HasFactory; use InteractsWithMedia;

    protected $fillable = ['document_type','document_number','document_issue_date','document_expiry_date','document_notes','customer_id'];
    

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
