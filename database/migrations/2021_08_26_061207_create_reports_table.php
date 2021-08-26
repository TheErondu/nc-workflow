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
            $table->string('bulletin_1');
            $table->string('dts_in');
            $table->string('actual_in');
            $table->string('variance');
            $table->string('dts_out');
            $table->string('actual_out');
            $table->string('variance');
            $table->string('comment');
            $table->string('bulletin_2');
            $table->string('dts_in');
            $table->string('actual_in');
            $table->string('variance');
            $table->string('dts_out');
            $table->string('actual_out');
            $table->string('variance');
            $table->string('comment');
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
