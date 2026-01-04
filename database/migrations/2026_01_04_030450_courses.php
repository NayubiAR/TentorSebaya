<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_transactions_table.php
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Siapa yang beli
            $table->foreignId('course_id')->constrained(); // Video apa yang dibeli

            $table->integer('amount'); // Harga saat beli (misal 250000)
            $table->string('status')->default('pending'); // pending, success, failed
            $table->string('snap_token')->nullable(); // Untuk Midtrans (jika pakai)

            $table->timestamps();
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
