<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->char('allDay', 10)->default('true');
            $table->string('color', 50)->default('green');
            $table->string('status');
            $table->string('producer1');
            $table->string('producer2');
            $table->string('dop1');
            $table->string('dop2');
            $table->string('dop3');
            $table->string('dop4');
            $table->string('description');
            $table->string('video_editor')->nullable();
            $table->string('graphic_editor')->nullable();
            $table->string('digital_editor')->nullable();
            $table->string('others')->nullable();
            $table->timestamps();
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
