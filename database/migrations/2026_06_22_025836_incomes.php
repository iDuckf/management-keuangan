<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained(
                table: 'categories',
                indexName: 'incomes_category_id'
            )->cascadeOnDelete(); // Jika pakai sistem kategori
            $table->string('source'); // Contoh: Gaji, Freelance, dll.
            $table->decimal('amount', 15, 2); // Nominal uang
            $table->date('date'); // Tanggal pemasukan
            $table->text('description')->nullable(); // Catatan opsional
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
