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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name', 40)->nullable();
            $table->string('mobile', 11)->nullable();
            $table->string('item')->nullable();
            $table->integer('item_id')->unsigned()->nullable();
            $table->string('title', 50)->nullable();
            $table->text('content');
            $table->float('rate')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->integer('likes')->unsigned()->nullable();
            $table->integer('dislikes')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
