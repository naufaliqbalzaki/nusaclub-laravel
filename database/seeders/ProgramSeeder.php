<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'nama' => 'Dasar Renang',
                'level' => 'beginner',
                'deskripsi' => 'Program dasar untuk pemula, fokus pada penguasaan air, pernapasan, dan keselamatan.',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'nama' => 'Teknik Menengah',
                'level' => 'intermediate',
                'deskripsi' => 'Program menengah untuk peningkatan teknik renang, koordinasi gerakan, dan stamina.',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'nama' => 'Kompetisi & Profesional',
                'level' => 'advanced',
                'deskripsi' => 'Program lanjutan untuk persiapan kompetisi, endurance, dan simulasi pertandingan.',
                'urutan' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($programs as $program) {
            Program::updateOrCreate(
                ['slug' => Str::slug($program['nama'])],
                [
                    'nama' => $program['nama'],
                    'slug' => Str::slug($program['nama']),
                    'level' => $program['level'],
                    'deskripsi' => $program['deskripsi'],
                    'urutan' => $program['urutan'],
                    'is_active' => $program['is_active'],
                ]
            );
        }
    }
}