<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPushSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('push_subscriptions');
    }

    public function down()
    {
        Schema::create('push_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('endpoint', 500);
            $table->text('public_key')->nullable();
            $table->text('auth_token')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'endpoint'], 'push_subscriptions_user_endpoint_unique');
        });
    }
}
