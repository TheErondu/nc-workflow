<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrompterLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prompter_logs', function (Blueprint $table) {
            $table->id();
            $table->string('segment');
            $table->string('rundown_in');
            $table->string('script_in');
            $table->string('anchor');
            $table->string('director');
            $table->string('host');
            $table->string('comment');
            $table->string('graphics');
            $table->string('producer');
            $table->string('pa');
            $table->string('engineer');
            $table->string('challenges');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id', 'prompter_logs_user_id_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prompter_logs');
    }
}
