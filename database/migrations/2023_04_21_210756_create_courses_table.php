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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->text('summery')->nullable();
            $table->string('teacher_name')->nullable();
            $table->text('description')->nullable();
            $table->boolean('has_cover')->nullable();
            $table->boolean('has_video')->nullable();
            $table->integer('users_count')->default(0)->unsigned();
            $table->integer('views_count')->default(0)->unsigned();
            $table->integer('total_hours')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount_percent')->nullable()->unsigned();
            $table->float('rate')->nullable()->unsigned();
            $table->integer('score')->nullable()->unsigned();
            $table->integer('order')->nullable();
            $table->enum('status', ['completed', 'pre-sell', 'presenting', 'not_for_sale', 'inactive'])->default('completed');
            $table->integer('uploaded_count')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
