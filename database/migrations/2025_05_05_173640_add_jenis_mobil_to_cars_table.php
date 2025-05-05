<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisMobilToCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('jenis_mobil'); // Menambahkan kolom jenis_mobil
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('jenis_mobil'); // Menghapus kolom jenis_mobil jika rollback
        });
    }
}
