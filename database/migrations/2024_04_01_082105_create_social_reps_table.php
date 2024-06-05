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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ربط بجدول المستخدمين
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable()->unique();
            $table->string('image')->nullable(); // افتراض أن الصورة قد تكون فارغة
            $table->text('skills')->nullable(); // المهارات المتعلقة بالعمل
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
