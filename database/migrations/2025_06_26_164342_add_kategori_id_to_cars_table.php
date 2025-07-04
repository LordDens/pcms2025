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
        Schema::table('cars', function (Blueprint $table) {
            $table->foreignId('kategori_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }

};
