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
        Schema::table('courses', function (Blueprint $table) {
            $table->float('rate')->unsigned()->default(0)->change();
            $table->integer('score')->unsigned()->default(0)->change();
            $table->integer('uploaded_count')->default(0)->change();
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->integer('likes')->unsigned()->default(0)->change();
            $table->integer('dislikes')->unsigned()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
