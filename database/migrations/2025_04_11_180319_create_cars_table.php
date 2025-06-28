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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mobil')->unique();               // kode otomatis seperti INN-M1
            $table->string('nama_mobil');                         // contoh: "Innova"
            $table->string('jenis_mobil');                        // contoh: "MPV"
            $table->enum('transmisi', ['Manual', 'Matic']);       // transmisi pilihan
            $table->boolean('ready');                             // 1 = tersedia, 0 = tidak
            $table->decimal('harga_sewa_per_hari', 10, 2);        // harga sewa
            $table->foreignId('kategori_id')->constrained()->onDelete('cascade'); // relasi kategori
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
