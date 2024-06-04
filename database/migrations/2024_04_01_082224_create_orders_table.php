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
            $table->string('order_number');
            $table->date('order_date');
            $table->json('order_type');
            $table->boolean('is_commission')->default(0);
            $table->decimal('total', 10, 2);
            $table->decimal('tax_rate', 5, 2);
            $table->decimal('discount_rate', 5, 2);
            $table->decimal('total_final', 10, 2);
            $table->string('payment_method');
            $table->string('payment_type');
            $table->string('time_plementation_range');

                    $table->enum('payment_status', ['سداد جزئي', 'غير مسدد','مكتمل', 'فشل'])->default('غير مسدد');
            $table->enum('order_status', [ 'قيد التنفيذ', 'قيد الإعداد','قيد الإنشاء', 'تم التسليم', 'ملغي'])->default('قيد الإعداد');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
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
