<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, convert existing comma-separated views to JSON format
        $screens = DB::table('screens')->get();
        foreach ($screens as $screen) {
            if ($screen->views) {
                $viewsArray = array_map('trim', explode(',', $screen->views));
                DB::table('screens')
                    ->where('id', $screen->id)
                    ->update(['views' => json_encode($viewsArray)]);
            }
        }

        // Add new duration columns
        Schema::table('screens', function (Blueprint $table) {
            $table->integer('slide_duration')->default(7000)->after('views'); // milliseconds
            $table->integer('view_duration')->default(60000)->after('slide_duration'); // milliseconds
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('screens', function (Blueprint $table) {
            $table->dropColumn(['slide_duration', 'view_duration']);
        });

        // Convert JSON back to comma-separated
        $screens = DB::table('screens')->get();
        foreach ($screens as $screen) {
            if ($screen->views) {
                $viewsArray = json_decode($screen->views, true);
                if (is_array($viewsArray)) {
                    DB::table('screens')
                        ->where('id', $screen->id)
                        ->update(['views' => implode(',', $viewsArray)]);
                }
            }
        }
    }
}
