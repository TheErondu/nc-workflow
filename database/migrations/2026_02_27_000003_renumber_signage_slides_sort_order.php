<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RenumberSignageSlidesSortOrder extends Migration
{
    public function up()
    {
        $viewTypes = DB::table('signage_slides')
            ->distinct()
            ->pluck('view_type');

        foreach ($viewTypes as $viewType) {
            $slides = DB::table('signage_slides')
                ->where('view_type', $viewType)
                ->orderBy('id')
                ->pluck('id');

            foreach ($slides as $position => $id) {
                DB::table('signage_slides')
                    ->where('id', $id)
                    ->update(['sort_order' => $position + 1]);
            }
        }
    }

    public function down()
    {
        DB::table('signage_slides')->update(['sort_order' => 0]);
    }
}
