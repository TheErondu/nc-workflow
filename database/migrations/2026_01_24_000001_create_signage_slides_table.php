<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignageSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signage_slides', function (Blueprint $table) {
            $table->id();
            $table->string('view_type'); // birthdays, showreels, general
            $table->string('title')->nullable();
            $table->string('image_path');
            $table->date('active_from')->nullable();
            $table->date('active_until')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->index(['view_type', 'is_active']);
            $table->index(['active_from', 'active_until']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signage_slides');
    }
}
