<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('last_odometer_reading')->nullable();
            $table->decimal('kilometres', 10, 2)->storedAs("(`odometer_reading` - `last_odometer_reading`)");
            $table->decimal('cost_per_litre', 10, 2)->storedAs("(`fuel_cost` / `fuel_added`)");
            $table->decimal('mileage', 10, 2)->storedAs("(`kilometres` / `fuel_added`)");
            $table->decimal('cost_per_km', 10, 2)->storedAs("(`fuel_cost` / `kilometres`)");
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id', 'trackers_user_id_foreign')->references('id')->on('users');
            $table->foreign('vehicle_id', 'trackers_vehicle_id_foreign')->references('id')->on('vehicles');
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
