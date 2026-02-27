<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCelebrantNameToSignageSlides extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('signage_slides', function (Blueprint $table) {
            $table->string('celebrant_name')->nullable()->after('title');
            $table->date('birthday_date')->nullable()->after('celebrant_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('signage_slides', function (Blueprint $table) {
            $table->dropColumn(['celebrant_name', 'birthday_date']);
        });
    }
}
