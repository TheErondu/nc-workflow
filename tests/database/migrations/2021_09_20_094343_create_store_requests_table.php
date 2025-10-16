<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_requests', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('return_date');
            $table->unsignedBigInteger('user_id');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->foreign('user_id', 'store_requests_user_id_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_requests');
    }
}
