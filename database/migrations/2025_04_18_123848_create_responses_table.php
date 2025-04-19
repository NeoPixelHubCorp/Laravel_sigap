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
        Schema::create('responses', function (Blueprint $table) {
    $table->id();

    // Relasi ke complain
    $table->foreignId('complain_id')->constrained('complains')->onDelete('cascade');

    // Admin yang memberi respon
    $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');

    // Isi respon
    $table->longText('response')->nullable();

    // Optional: siapa yang update atau handle
    $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
    $table->foreignId('handled_by')->nullable()->constrained('users')->onDelete('set null');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
