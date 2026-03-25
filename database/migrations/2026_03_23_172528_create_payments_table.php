<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monthly_bill_id')->constrained('monthly_bills')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->date('tanggal_bayar');
            $table->decimal('nominal_bayar', 12, 2);
            $table->enum('metode_pembayaran', ['transfer', 'cash', 'qris']);
            $table->string('reference_no')->nullable();
            $table->text('catatan')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->foreignId('diterima_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};