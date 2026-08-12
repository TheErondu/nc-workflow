<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByToStoresTable extends Migration
{
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('created_by')->nullable()->after('assigned_department');
            $table->string('last_modified_by')->nullable()->after('created_by');
        });
    }

    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'last_modified_by']);
        });
    }
}
