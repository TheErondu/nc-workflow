<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        Schema::dropIfExists('mcr_logs');
    }
}
