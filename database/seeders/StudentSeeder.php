<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $programs = Program::where('is_active', true)->orderBy('urutan')->get();
        $packages = Package::where('is_active', true)->get();

        $names = [
            'Alya Putri',
            'Rafa Pratama',
            'Nabila Azzahra',
            'Fahri Ramadhan',
            'Kayla Maharani',
            'Arkan Saputra',
            'Salsa Putri',
            'Daffa Alfarizi',
            'Naura Khairunnisa',
            'Raka Maulana',
            'Cinta Lestari',
            'Zidan Akbar',
            'Aisyah Humaira',
            'Farhan Hakim',
            'Nadira Safitri',
            'Gibran Maulana',
            'Syifa Aulia',
            'Adnan Firdaus',
            'Tiara Ramadhani',
            'Rasyid Fadilah',
            'Azka Pramudya',
            'Shakila Nur',
            'Ilham Prakoso',
            'Keisha Anindya',
            'Farel Nugraha',
            'Salsabila Rahma',
            'Abizar Fikri',
            'Nayla Putri',
            'Reyhan Ardiansyah',
            'Zahra Azzahra',
        ];

        foreach ($names as $index => $name) {
            $program = $programs->count() ? $programs[$index % $programs->count()] : null;
            $package = $packages->count() ? $packages[$index % $packages->count()] : null;

            Student::updateOrCreate(
                [
                    'whatsapp' => '08123000' . str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT),
                ],
                [
                    'nama' => $name,
                    'usia' => rand(5, 14),
                    'alamat' => 'Gresik',
                    'program_id' => $program?->id,
                    'package_id' => $package?->id,
                    'tanggal_mulai' => Carbon::now()->subDays(rand(1, 180))->toDateString(),
                    'status' => 'aktif',
                    'catatan' => 'Data dummy awal siswa',
                ]
            );
        }
    }
}