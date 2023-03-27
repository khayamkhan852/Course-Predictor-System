<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVbodyVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vbody_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vbody_id')->constrained('vbodies');
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
        Schema::dropIfExists('vbody_vehicle');
    }
}
