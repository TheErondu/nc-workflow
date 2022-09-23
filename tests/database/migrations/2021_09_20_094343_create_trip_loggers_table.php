<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripLoggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_loggers', function (Blueprint $table) {
            $table->id();
            $table->string('number_plate');
            $table->string('production_name');
            $table->date('trip_date');
            $table->string('assigned_driver');
            $table->string('odometer_start');
            $table->string('odometer_stop');
            $table->string('trip_information');
            $table->string('trip_distance');
            $table->string('fuel_station');
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
        Schema::dropIfExists('trip_loggers');
    }
}
