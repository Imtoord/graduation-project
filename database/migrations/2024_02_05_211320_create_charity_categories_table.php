<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('charity_category', function (Blueprint $table) {
        $table->id('CharityCategoryID');
        $table->foreignId('charity_id')->constrained('charities', 'CharityID')->onDelete('cascade');
        $table->foreignId('category_id')->constrained('categories', 'CategoryID')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charity_category');
    }

};
