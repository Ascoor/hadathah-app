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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('sale_rep_id')->constrained()->onDelete('cascade');
            $table->foreignId('designer_id')->constrained()->onDelete('cascade');
            $table->date('order_date');
            $table->enum('order_type', ['طباعة وتصميم', 'منتجات مطبوعة', 'خدمات', 'نشر وتسويق']);
            $table->boolean('is_commission')->default(0);
            $table->decimal('total', 10, 2);
            $table->decimal('tax_rate', 5, 2);
            $table->decimal('discount_rate', 5, 2);
            $table->decimal('total_final', 10, 2);
            $table->enum('payment_status', ['سداد جزئي', 'مكتمل', 'فشل'])->default('سداد جزئي');
            $table->enum('order_status', ['طباعة', 'قيد التنفيذ', 'تحت الإنشاء', 'تم التسليم', 'ملغي'])->default('قيد التنفيذ');
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
