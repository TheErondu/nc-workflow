<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->timestamps();
        });

        // Seed the default location so id=1 exists before foreign keys reference it
        DB::table('locations')->insert(['id' => 1, 'name' => 'Lagos', 'created_at' => now(), 'updated_at' => now()]);
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
