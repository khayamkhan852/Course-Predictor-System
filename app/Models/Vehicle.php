<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Vehicle extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'type',
        'engine_type',
        'color',
        'model',
        'brand',
        'fuel_capacity',
        'flevel_id',
        'fuel_consumption',
        'doors',
        'seats',
        'large_bags',
        'small_bags',
        'vin',
        'imei',
        'branch_id',
        'vehicle_status_id',
        'business_setting_id',
        'partner_id',
        'user_id'
    ];


    public static function boot() : void {
        parent::boot();

        static::deleting(static function ($vehicle) {
            $vehicleDamage = $vehicle->vehicleDamage()->first();
            if ($vehicleDamage !== null) {
                $vehicleDamage->delete();
            }
        });

        static::creating(static function($vehicle) {
            $vehicle->user_id = auth()->id();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function flevel(): BelongsTo
    {
        return $this->belongsTo(Flevel::class, 'flevel_id');
    }

    public function vehicle_status(): BelongsTo
    {
        return $this->belongsTo(VehicleStatus::class, 'vehicle_status_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Vgroup::class, 'vehicle_vgroup');
    }

    public function vehicleDrives(): BelongsToMany
    {
        return $this->belongsToMany(Vdrive::class, 'vdrive_vehicle');
    }

    public function vehicleFuels(): BelongsToMany
    {
        return $this->belongsToMany(Fueltype::class, 'fueltype_vehicle');
    }

    public function vehicleBodyTypes(): BelongsToMany
    {
        return $this->belongsToMany(Vbody::class, 'vbody_vehicle');
    }

    public function vehicleTransmissions(): BelongsToMany
    {
        return $this->belongsToMany(Vtransmission::class, 'vehicle_vtransmission', 'vehicle_id', 'vtransmission_id');
    }

    public function vehicleFacilities(): HasMany
    {
        return $this->hasMany(VehicleFacility::class, 'vehicle_id');
    }

    public function vehicleDamage(): HasOne
    {
        return $this->hasOne(VehicleDamage::class, 'vehicle_id');
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(BusinessSetting::class, 'business_setting_id');
    }


}
