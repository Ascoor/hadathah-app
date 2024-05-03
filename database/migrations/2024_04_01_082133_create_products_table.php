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
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description')->nullable(); // جعل الوصف اختياريًا
    $table->decimal('price', 8, 2); // تحديد السعر بدقة تصل إلى مئتين
    $table->string('image')->nullable(); // جعل الصورة اختيارية
    $table->foreignId('category_id')->constrained()->onDelete('cascade'); // مفتاح خارجي للفئة مع حذف تلقائي عند حذف الفئة
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
        Schema::dropIfExists('products');
    }
};
