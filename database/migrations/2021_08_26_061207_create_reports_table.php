<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('bulletin');
            $table->string('dts_in');
            $table->string('actual_in');
            $table->string('variance1');
            $table->string('dts_out');
            $table->string('actual_out');
            $table->string('variance2');
            $table->string('comment');
            $table->string('b2bulletin');
            $table->string('b2dts_in');
            $table->string('b2actual_in');
            $table->string('b2variance1');
            $table->string('b2dts_out');
            $table->string('b2actual_out');
            $table->string('b2variance2');
            $table->string('b2comment');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('reports');
    }
}
