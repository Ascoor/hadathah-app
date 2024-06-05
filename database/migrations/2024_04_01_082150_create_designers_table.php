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
        Schema::create('designers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // ربط بجدول المستخدمين وحذف السجلات المرتبطة عند حذف المستخدم
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable()->unique();
            $table->string('image')->nullable();  // الصورة قد تكون فارغة
            $table->text('skills');  // مهارات المصمم
            $table->timestamps();  // إنشاء `created_at` و `updated_at` تلقائيًا
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designers');
    }
};
