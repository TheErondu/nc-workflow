<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
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
            $table->foreign('user_id', 'o_blogs_user_id_foreign')->references('id')->on('users');
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
