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
        Schema::create('order_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_rep_id')->constrained('sale_reps')->onDelete('cascade');
            $table->foreignId('social_rep_id')->nullable()->constrained('social_reps')->onDelete('set null');
            $table->foreignId('designer_id')->nullable()->constrained('designers')->onDelete('set null');
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_employees');
    }
};
