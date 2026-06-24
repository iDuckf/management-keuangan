<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'categories_user_id'
            )->cascadeOnDelete(); // Relasi ke table users  
            $table->string('name'); // Nama kategori: Gaji, Makanan, Investasi
            $table->string('slug'); // Untuk URL friendly (gaji, makanan, investasi)
            $table->unique(['user_id', 'slug']);
            $table->enum('type', ['income', 'expense']); // Membedakan kategori pemasukan / pengeluaran
            $table->string('color', 7)->nullable(); // Kode warna hex untuk grafik (contoh: #4e73df)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
