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
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('mobile', 16)->nullable();
            $table->string('code');
            $table->enum('action', ['forgot_password', 'verify'])->nullable();
            $table->timestamps();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('expired_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};
