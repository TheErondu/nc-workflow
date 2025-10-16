<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransmissionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transmission_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('tc_on_duty');
            $table->text('first_interval');
            $table->text('second_interval');
            $table->text('third_interval');
            $table->text('remarks');
            $table->string('closed_at');
            $table->timestamps();
            $table->foreign('user_id', 'transmission_reports_user_id_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transmission_reports');
    }
}
