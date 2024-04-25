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

        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_number')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('sale_rep_id');
            $table->dateTime('offer_date');
            $table->json('products');
            $table->decimal('total', 10, 2);
            $table->decimal('tax_rate', 10, 2)->default(0);
            $table->decimal('discount_rate', 10, 2)->default(0);
            $table->decimal('total_final', 10, 2);
            $table->string('payment_method')->default('cash');
            $table->string('transaction_id')->nullable();
            $table->decimal('payment_amount', 10, 2)->nullable();
            $table->string('payment_type')->default('full'); // Could be 'full' or 'partial'
            $table->boolean('is_active')->default(true);
            $table->dateTime('valid_until');
            $table->enum('status', ['active', 'inactive', 'converted'])->default('active');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('sale_rep_id')->references('id')->on('sale_reps')->onDelete('cascade');
        });
  
        }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
};
