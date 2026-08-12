<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoToSignageSlidesTable extends Migration
{
    public function up()
    {
        Schema::table('signage_slides', function (Blueprint $table) {
            $table->string('slide_type', 10)->default('image')->after('view_type');
            $table->string('video_path')->nullable()->after('image_path');
        });
    }

    public function down()
    {
        Schema::table('signage_slides', function (Blueprint $table) {
            $table->dropColumn(['slide_type', 'video_path']);
        });
    }
}
