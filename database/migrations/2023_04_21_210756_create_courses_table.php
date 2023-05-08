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
            $table->string('name');
            $table->text('summery')->nullable();
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('users_count')->default(0)->unsigned();
            $table->integer('views_count')->default(0)->unsigned();
            $table->float('total_hours')->nullable();
            $table->float('price')->nullable();
            $table->integer('discount_percent')->nullable()->unsigned();
            $table->float('score')->nullable()->unsigned();
            $table->integer('order')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
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
