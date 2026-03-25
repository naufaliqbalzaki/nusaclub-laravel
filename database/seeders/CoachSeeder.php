<?php

namespace Database\Seeders;

use App\Models\Coach;
use Illuminate\Database\Seeder;

class CoachSeeder extends Seeder
{
    public function run(): void
    {
        $coaches = [
            [
                'nama' => 'M. Fatchur Rhoman',
                'jabatan' => 'Pelatih Renang',
                'deskripsi' => 'Pelatih renang NusaClub yang berfokus pada pembelajaran teknik dasar hingga lanjutan.',
                'foto' => null,
                'instagram' => null,
                'twitter' => null,
                'linkedin' => null,
                'is_active' => true,
            ],
            [
                'nama' => 'Abdul Hamd',
                'jabatan' => 'Pelatih Renang',
                'deskripsi' => 'Pelatih renang NusaClub yang membimbing peserta dengan pendekatan sabar, terarah, dan efektif.',
                'foto' => null,
                'instagram' => null,
                'twitter' => null,
                'linkedin' => null,
                'is_active' => true,
            ],
            [
                'nama' => 'Raihan Achmad',
                'jabatan' => 'Pelatih Renang',
                'deskripsi' => 'Pelatih renang NusaClub yang mendampingi peserta untuk meningkatkan teknik, stamina, dan kepercayaan diri di air.',
                'foto' => null,
                'instagram' => null,
                'twitter' => null,
                'linkedin' => null,
                'is_active' => true,
            ],
        ];

        foreach ($coaches as $coach) {
            Coach::updateOrCreate(
                ['nama' => $coach['nama']],
                $coach
            );
        }
    }
}