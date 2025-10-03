<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceSchedulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('maintenance_schedulers')) {
        Schema::create('maintenance_schedulers', function (Blueprint $table) {
            $table->id();
            $table->foreignid('user_id')->constrained();
            $table->string('title')->nullable(true);
            $table->string('start')->nullable(true);
            $table->string('end')->nullable(true);
            $table->string('status')->nullable(true);
            $table->string('notes')->nullable(true);
            $table->string('priority')->nullable(true);
            $table->timestamps();
        });
    }
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_schedulers');
    }
}
