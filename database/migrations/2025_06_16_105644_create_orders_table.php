<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik');
            $table->date('tanggal_pesan');
            $table->date('tanggal_kembali');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->boolean('with_driver');
            $table->string('ktp_path'); // nama file gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
