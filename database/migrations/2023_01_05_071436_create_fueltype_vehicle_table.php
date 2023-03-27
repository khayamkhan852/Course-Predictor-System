<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFueltypeVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fueltype_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fueltype_id')->constrained('fueltypes');
            $table->foreignId('vehicle_id')->constrained('vehicles')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fueltype_vehicle');
    }
}
