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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->unsigned()->nullable();
            $table->string('user_ids')->nullable();
            $table->string('product_ids')->nullable();
            $table->string('category_ids')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('code')->nullable();
            $table->integer('percent')->unsigned()->nullable();
            $table->integer('amount')->unsigned()->nullable();
            $table->integer('max_amount')->unsigned()->nullable();
            $table->integer('min_purchase_amount')->unsigned()->nullable();
            $table->string('used')->nullable();
            $table->string('count')->nullable();
            $table->timestamps();
            $table->timestamp('expired_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
