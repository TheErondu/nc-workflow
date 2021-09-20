<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        Schema::dropIfExists('prompter_logs');
    }
}
