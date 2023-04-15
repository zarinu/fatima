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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('buyer_id')->unsigned()->nullable();
            $table->integer('order_id')->unsigned()->nullable();
            $table->integer('gateway_id')->unsigned()->nullable();
            $table->string('amount');
            $table->string('ref_id')->nullable();
            $table->string('tracking_code')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->integer('paid_at')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
