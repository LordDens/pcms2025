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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->decimal('harga_sewa', 10, 2);
            $table->boolean('with_driver')->default(false);
            $table->string('driver')->nullable(); // 'YORDAN', 'TANPA SOPIR', etc
            $table->decimal('diskon', 10, 2)->nullable();
            $table->decimal('dp', 10, 2)->nullable();
            $table->decimal('total_pendapatan', 10, 2)->nullable();
            $table->decimal('belum_terbayar', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
