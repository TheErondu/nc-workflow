<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Visitor's name or appointment title
            $table->string('email'); // Visitor's email
            $table->string('phone')->nullable(); // Visitor's phone number
            $table->string('photo')->nullable(); // Visitor's photo
            $table->dateTime('start'); // Start time of the appointment
            $table->dateTime('end'); // End time of the appointment
            $table->string('status')->default('pending'); // Appointment status (pending, confirmed, cancelled)
            $table->text('description')->nullable(); // Additional details or message
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Associated user
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
        Schema::dropIfExists('appointments');
    }
}
