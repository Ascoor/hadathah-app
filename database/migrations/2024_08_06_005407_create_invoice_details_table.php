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
       
            Schema::create('invoice_details', function (Blueprint $table) {
                $table->bigIncrements('invoice_detail_id'); // تعريف العمود كمفتاح أساسي
                $table->unsignedBigInteger('invoice_id'); // تأكد من نوع البيانات
                $table->unsignedBigInteger('product_id');
                $table->integer('quantity');
                $table->decimal('price', 10, 2);
                $table->decimal('total', 10, 2);
                $table->timestamps();
    
                $table->foreign('invoice_id')->references('invoice_id')->on('invoices')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            });
        }
    

    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
};
