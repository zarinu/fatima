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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('payment_id')->unsigned()->nullable();
            $table->integer('price')->unsigned()->nullable();
            $table->integer('discount_price')->unsigned()->nullable();
            $table->integer('total_price')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'failed', 'success'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('price')->unsigned()->nullable();
            $table->integer('discount_price')->unsigned()->nullable();
            $table->integer('total_price')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('orders_items');
    }
};
