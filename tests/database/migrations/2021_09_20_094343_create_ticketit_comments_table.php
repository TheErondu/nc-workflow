<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketitCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketit_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('content');
            $table->longText('html')->nullable();
            $table->unsignedInteger('user_id')->index('ticketit_comments_user_id_index');
            $table->unsignedInteger('ticket_id')->index('ticketit_comments_ticket_id_index');
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
        Schema::dropIfExists('ticketit_comments');
    }
}
