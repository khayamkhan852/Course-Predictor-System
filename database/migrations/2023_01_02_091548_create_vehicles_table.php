<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('engine_type');
            $table->string('color')->default('white');
            $table->string('model');
            $table->string('brand');
            $table->string('fuel_capacity');
            $table->foreignId('flevel_id')->nullable()->constrained('flevels');
            $table->string('fuel_consumption');
            $table->unsignedInteger('doors');
            $table->unsignedInteger('seats');
            $table->unsignedInteger('large_bags')->default(0);
            $table->unsignedInteger('small_bags')->default(0);
            $table->string('vin')->nullable();
            $table->string('imei')->nullable();

            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->foreignId('vehicle_status_id')->nullable()->constrained('vehicle_statuses');
            $table->foreignId('business_setting_id')->nullable()->constrained('business_settings');
            $table->foreignId('partner_id')->nullable()->constrained('partners');

            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
