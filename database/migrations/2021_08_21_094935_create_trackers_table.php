<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->string('odometer_reading');
            $table->date('refuel_date');
            $table->string('fuel_added');
            $table->string('fuel_cost');
            $table->string('last_odometer_reading')->nullable(20);
            $table->decimal('kilometres',10, 2)->storedAs('odometer_reading - last_odometer_reading')->nullable();
            $table->decimal('cost_per_litre',10, 2)->storedAs('fuel_cost / fuel_added')->nullable();
            $table->decimal('mileage',10, 2)->storedAs('kilometres / fuel_added')->nullable();
            $table->decimal('cost_per_km',10, 2)->storedAs('fuel_cost / kilometres')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
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
        Schema::dropIfExists('trackers');
    }
}
