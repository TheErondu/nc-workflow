<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketitSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketit_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang')->nullable()->index()->unique();
            $table->string('slug')->index()->unique();
            $table->mediumText('value');
            $table->mediumText('default');
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
        Schema::dropIfExists('ticketit_settings');
    }
}
