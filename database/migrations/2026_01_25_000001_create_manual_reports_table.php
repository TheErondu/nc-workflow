<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualReportsTable extends Migration
{
    public function up()
    {
        Schema::create('manual_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('report_type');
            $table->text('content');
            $table->date('report_date');
            $table->timestamps();

            $table->index('report_type');
            $table->index('report_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('manual_reports');
    }
}
