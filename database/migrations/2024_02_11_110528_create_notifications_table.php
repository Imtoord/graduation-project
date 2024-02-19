<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            // $table->boolean('is_read')->default(false);
            $table->unsignedBigInteger('payment_id')->nullable();
            // $table->unsignedBigInteger('review_id')->nullable();
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamps();
             
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            // $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
            $table->foreign('campaign_id')->references('CampaignID')->on('campaigns')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
