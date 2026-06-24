<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained(
                table: 'categories',
                indexName: 'expenses_category_id'
            )->cascadeOnDelete(); // Relasi ke tabel kategori
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'expenses_user_id'
            )->cascadeOnDelete(); // Relasi ke table users
            $table->string('title'); // Contoh: Bayar Kos, Makan Siang
            $table->decimal('amount', 15, 2); // Nominal pengeluaran
            $table->date('date'); // Tanggal pengeluaran
            $table->text('description')->nullable(); // Catatan opsional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
