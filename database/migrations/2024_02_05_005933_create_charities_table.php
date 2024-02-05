<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('charities', function (Blueprint $table) {
            $table->id('CharityID');
            $table->string('CharityName')->unique();
            $table->text('Description');
            $table->string('Email')->unique();
            $table->string('Phone')->unique();
            $table->text('Address');
            $table->string('Logo')->nullable();
            $table->date('RegistrationDate');
            $table->string('FounderName');
            $table->year('EstablishedYear');
            $table->decimal('DonationTotal', 10, 2)->default(0);
            $table->boolean('IsActive')->default(true);
            $table->timestamps(); 
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charities');
    }
};
