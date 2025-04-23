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
        Schema::table('complains', function (Blueprint $table) {
            /// Mengubah kolom tanggal_aduan menjadi timestamp
            $table->timestamp('tanggal_aduan')->useCurrent()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complains', function (Blueprint $table) {
            // Mengembalikan kolom tanggal_aduan ke date
            $table->date('tanggal_aduan')->nullable()->change();
        });
    }
};
