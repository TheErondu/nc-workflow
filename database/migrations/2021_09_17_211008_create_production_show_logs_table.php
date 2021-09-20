<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionShowLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_show_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('location');
            $table->string('producer1');
            $table->string('producer2');
            $table->string('director');
            $table->string('vision_mixer');
            $table->string('engineer');
            $table->string('sound_technician');
            $table->string('camera_operator1');
            $table->string('camera_operator2');
            $table->string('host');
            $table->string('graphics');
            $table->string('digital');
            $table->string('transmission');
            $table->string('transmission_time');
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('production_show_logs');
    }
}
