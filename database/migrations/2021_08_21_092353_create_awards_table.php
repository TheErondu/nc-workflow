<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('show_title')->nullable();
            $table->string('showing_time')->nullable();
            $table->string('show_location')->nullable();
            $table->string('photo')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('picture')->nullable();
            $table->string('fullname1')->nullable();
            $table->string('fullname2')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('commendation')->nullable();

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
        Schema::dropIfExists('awards');
    }
}
