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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('CommentID');
            $table->foreignId('UserID')->constrained('users'); // Assuming the table name for users is 'users'
            $table->date('date');
            $table->integer('Rating');
            $table->text('Content')->required();
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns

            // You can add additional indexes or constraints if needed
            // Example: $table->unique(['UserID', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
