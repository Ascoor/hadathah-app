<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_reps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique()->nullable();
            $table->foreignId('password_id')->constrained('passwords');
            $table->string('image')->nullable(); // افتراض أن الصورة قد تكون فارغة
            $table->text('covered_areas'); // أو يمكنك استخدام `string` إذا كانت المناطق المغطاة قصيرة
            $table->timestamps(); // إنشاء `created_at` و `updated_at` تلقائيًا
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_reps');
    }
};
