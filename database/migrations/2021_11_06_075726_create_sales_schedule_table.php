<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sales_schedules')) {
        Schema::create('sales_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignid('user_id')->constrained();
            $table->string('client_type')->nullable(true);
            $table->string('name')->nullable(true);
            $table->string('sales_exec_ext')->nullable(true);
            $table->string('client_cell')->nullable(true);
            $table->string('start')->nullable(true);
            $table->string('brief_in_time')->nullable(true);
            $table->string('end')->nullable(true);
            $table->string('sales_exec_name')->nullable(true);
            $table->string('type_of_production')->nullable(true);
            $table->string('production_requirements')->nullable(true);
            $table->string('production_period')->nullable(true);
            $table->string('status')->nullable(true);
            $table->string('approved_by')->nullable(true);
            $table->string('product')->nullable(true);
            $table->string('approval_comments')->nullable(true);
            $table->string('resolved_date')->nullable(true);
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
        Schema::dropIfExists('sales_schedule');
    }
}
