<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->foreignId('program_id')
                ->nullable()
                ->after('usia')
                ->constrained('programs')
                ->nullOnDelete();

            $table->enum('status', ['baru', 'dihubungi', 'trial', 'diterima', 'aktif', 'batal'])
                ->default('baru')
                ->after('catatan');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('program_id');
            $table->dropColumn('status');
        });
    }
};