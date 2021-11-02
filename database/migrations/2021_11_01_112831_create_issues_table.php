<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->foreignid('user_id')->constrained();
            $table->string('item_name');
            $table->string('description');
            $table->string('date');
            $table->string('location');
            $table->string('raised_by');
            $table->string('department');
            $table->string('status');
            $table->string('fixed_by');
            $table->string('action_taken');
            $table->string('cause_of_breakdown');
            $table->string('engineers_comment');
            $table->string('resolved_date');
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
        Schema::dropIfExists('issues');
    }
}
