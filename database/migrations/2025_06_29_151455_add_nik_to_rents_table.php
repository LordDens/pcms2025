<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->string('nik', 16)->nullable(); // tanpa after()
        });
    }

    public function down(): void
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->dropColumn('nik');
        });
    }
};
