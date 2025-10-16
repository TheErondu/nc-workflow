<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('start');
            $table->date('end');
            $table->string('genre');
            $table->string('team_lead');
            $table->date('delivery_date');
            $table->string('country');
            $table->string('location');
            $table->string('status');
            $table->string('distribution_platform');
            $table->string('project_brief');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id', 'contents_user_id_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
