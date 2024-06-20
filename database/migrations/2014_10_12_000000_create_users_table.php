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

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('activation_code', 30)->nullable();
            $table->timestamp('reset_token_expires_at')->nullable();
       
            $table->foreignId('role_id')->default(3)->constrained('roles'); // Link to roles table
            $table->string('password');
            $table->boolean('is_active')->default(false); // Add is_active column with default false
            $table->string('reset_token', 60)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    
    {
        Schema::dropIfExists('users');
    }
};
