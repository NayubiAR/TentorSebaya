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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // Relasi: Siapa yang beli?
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Relasi: Beli kelas apa?
            $table->foreignId('course_id')->constrained()->onDelete('cascade');

            // Info Transaksi
            $table->string('invoice_code')->unique(); // Contoh: TRX-001
            $table->integer('amount'); // Harga total bayar
            $table->string('status')->default('pending'); // pending, success, failed

            // Khusus Midtrans (Nanti dipakai)
            $table->string('snap_token')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
