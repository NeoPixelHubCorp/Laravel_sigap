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
    Schema::create('complains', function (Blueprint $table) {
            $table->id();
            // Relasi
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            // Data utama
            $table->string('no_aduan')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('location');
            // Status dan akses
            $table->enum('status', [
                'pending',
                'diverifikasi',
                'diteruskan_ke_instansi',
                'dalam_penanganan',
                'selesai'
            ])->default('pending');
            $table->enum('visibility', ['public', 'private'])->default('private');
            // Tambahan opsional
            $table->date('tanggal_aduan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
