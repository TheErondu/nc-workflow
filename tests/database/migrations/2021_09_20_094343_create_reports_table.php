<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedBigInteger('user_id');
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
            $table->timestamps();
            $table->foreign('user_id', 'reports_user_id_foreign')->references('id')->on('users');
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
