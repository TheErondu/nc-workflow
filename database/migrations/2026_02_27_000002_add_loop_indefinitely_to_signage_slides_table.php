<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoopIndefinitelyToSignageSlidesTable extends Migration
{
    public function up()
    {
        Schema::table('signage_slides', function (Blueprint $table) {
            $table->boolean('loop_indefinitely')->default(false)->after('is_active');
        });
    }

    public function down()
    {
        Schema::table('signage_slides', function (Blueprint $table) {
            $table->dropColumn('loop_indefinitely');
        });
    }
}
