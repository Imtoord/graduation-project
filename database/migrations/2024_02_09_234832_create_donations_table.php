<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('charity_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('campaign_id');
            $table->text('notes')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('status');
            $table->date('date');
            $table->boolean('is_payment')->default(false);
            $table->timestamps();
 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('charity_id')->references('CharityID')->on('charities')->onDelete('cascade');
            $table->foreign('category_id')->references('CategoryID')->on('categories')->onDelete('cascade');
            $table->foreign('campaign_id')->references('CampaignID')->on('campaigns')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
