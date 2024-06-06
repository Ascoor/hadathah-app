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
        
        Schema::create('social_reps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Link to the users table
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique()->nullable();
            $table->string('image')->nullable(); // Assuming the image may be optional
            $table->text('skills')->nullable(); // Text field for storing various skills
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_reps');
    }
};
