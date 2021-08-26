<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('team_lead');
            $table->string('genre');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('delivery_date');
            $table->string('country');
            $table->string('location');
            $table->string('status');
            $table->string('distribution_platform');
            $table->string('project_brief');
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
        Schema::dropIfExists('contents');
    }
}
