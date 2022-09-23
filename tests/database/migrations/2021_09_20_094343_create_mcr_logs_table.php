<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcrLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcr_logs', function (Blueprint $table) {
            $table->id();
            $table->string('sto');
            $table->string('timing');
            $table->string('programmes');
            $table->string('remarks');
            $table->string('squeezbacks');
            $table->string('tc');
            $table->string('traffic');
            $table->string('handed_over_to');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id', 'mcr_logs_user_id_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcr_logs');
    }
}
