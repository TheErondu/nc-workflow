<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id', 'production_show_logs_user_id_foreign')->references('id')->on('users');
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
