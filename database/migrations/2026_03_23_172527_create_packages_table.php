<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->nullable()->constrained('programs')->nullOnDelete();
            $table->string('nama');
            $table->enum('tipe_tagihan', ['monthly', 'one_time', 'per_session']);
            $table->decimal('harga', 12, 2);
            $table->string('durasi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('jadwal')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};