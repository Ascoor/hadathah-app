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
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('image')->nullable(); // افتراض أن الصورة قد تكون فارغة
            $table->text('skills')->nullable(); // أو يمكنك استخدام `string` إذا كانت المناطق المغطاة قصيرة
            $table->timestamps(); // إنشاء `created_at` و `updated_at` تلقائيًا
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
