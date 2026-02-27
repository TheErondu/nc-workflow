<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoLogsTable extends Migration
{
    public function up()
    {
        Schema::create('sto_logs', function (Blueprint $table) {
            $table->id();
            $table->string('sto')->nullable();
            $table->string('timing')->nullable();
            $table->string('programmes')->nullable();
            $table->text('remarks')->nullable();
            $table->string('squeezbacks')->nullable();
            $table->string('tc')->nullable();
            $table->string('traffic')->nullable();
            $table->string('handed_over_to')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->datetime('start')->nullable();
            $table->datetime('end')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sto_logs');
    }
}
