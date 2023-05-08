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
            $table->integer('address_id')->unsigned()->nullable();
            $table->integer('payment_id')->unsigned()->nullable();
            $table->integer('delivery_method_id')->unsigned()->nullable();
            $table->integer('payment_method_id')->unsigned()->nullable();
            $table->integer('discount_id')->unsigned()->nullable();

            $table->integer('tax_price')->unsigned()->nullable();
            $table->integer('delivery_method_price')->unsigned()->nullable();

            $table->integer('discount_price')->unsigned()->nullable();
            $table->integer('automatic_discount_price')->unsigned()->nullable();
            $table->integer('products_discount_price')->unsigned()->nullable();
            $table->integer('payment_method_discount_price')->unsigned()->nullable();

            $table->integer('total_price')->unsigned()->nullable();
            $table->integer('total_discounts_price')->unsigned()->nullable();

            $table->text('barcode')->nullable();
            $table->string('tracking_code')->nullable();
            $table->string('discount_code')->nullable();
            $table->text('description')->nullable();

            $table->enum('status', ['pending', 'accepted', 'failed', 'preparing', 'sent', 'delivered', 'reserved', 'returned', 'incomplete', 'sent_postal_system', 'deleted'])->default('pending');
            $table->enum('shipping_status', ['not_loaded', 'not_need', 'exit_warehouse', 'delivered_to_customer', 'delivered_to_postal_system', 'incomplete_delivery'])->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('gift_id')->unsigned()->nullable();
            $table->integer('warehouse_id')->unsigned();
            $table->enum('type', ['gift', 'product'])->default('product');
            $table->integer('count')->unsigned()->nullable();
            $table->integer('price')->unsigned()->nullable();
            $table->integer('discount_price')->unsigned()->nullable();
            $table->integer('tax_price')->unsigned()->nullable();
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
