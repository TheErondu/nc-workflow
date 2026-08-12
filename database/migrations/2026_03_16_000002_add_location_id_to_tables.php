<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationIdToTables extends Migration
{
    private $tables = [
        'store_items',
        'stores',
        'store_requests',
        'schedules',
        'users',
    ];

    public function up()
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName) && !Schema::hasColumn($tableName, 'location_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->unsignedBigInteger('location_id')->default(1)->after('id');
                    $table->foreign('location_id')->references('id')->on('locations');
                });
            }
        }
    }

    public function down()
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'location_id')) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    $table->dropForeign([$tableName . '_location_id_foreign']);
                    $table->dropColumn('location_id');
                });
            }
        }
    }
}
