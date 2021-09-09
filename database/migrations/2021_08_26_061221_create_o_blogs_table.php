<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('event_date');
            $table->string('location');
            $table->string('producer');
            $table->string('director');
            $table->string('vision_mixer');
            $table->string('sound');
            $table->string('engineer');
            $table->string('dop');
            $table->string('reporter');
            $table->string('digital');
            $table->string('transmission_time');
            $table->string('comment');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
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
        Schema::dropIfExists('o_blogs');
    }
}
