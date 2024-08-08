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
          
      
            Schema::create('invoices', function (Blueprint $table) {
                $table->id('invoice_id'); // تعريف العمود كمفتاح أساسي
                $table->date('invoice_date');
                $table->string('invoice_number');
                $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
                $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
                $table->decimal('total_before_discount_and_tax', 10, 2); // الإجمالي قبل الخصم والضريبة
                $table->decimal('total_after_discount_and_tax', 10, 2); // الإجمالي بعد الخصم والضريبة
                $table->string('status');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }

};
