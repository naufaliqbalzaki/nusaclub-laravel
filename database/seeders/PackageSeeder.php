<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Program;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $beginnerProgram = Program::where('slug', 'dasar-renang')->first();
        $advancedProgram = Program::where('slug', 'kompetisi-profesional')->first();

        $packages = [
            [
                'program_id' => $beginnerProgram?->id,
                'nama' => 'Paket Reguler',
                'tipe_tagihan' => 'monthly',
                'harga' => 275000,
                'durasi' => '4x per bulan',
                'deskripsi' => "Usia TK A – Kelas 1 SD\nTiket anak & 1 pengantar\n1 Pelatih : Max 4 anak",
                'jadwal' => "Selasa – Kamis, 14.00 WIB\nJumat & Sabtu, 15.00 WIB",
                'is_active' => true,
            ],
            [
                'program_id' => $advancedProgram?->id,
                'nama' => 'Paket Privat',
                'tipe_tagihan' => 'per_session',
                'harga' => 150000,
                'durasi' => 'Per sesi',
                'deskripsi' => "Usia TK – SMA\nTiket anak & 1 pengantar sudah termasuk\nOne-on-One Coaching",
                'jadwal' => "Hari Minggu\nSesi 1: 09.00 WIB\nSesi 2: 10.15 WIB",
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            Package::updateOrCreate(
                ['nama' => $package['nama']],
                $package
            );
        }
    }
}