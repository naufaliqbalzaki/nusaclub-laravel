<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'pertanyaan' => 'Apakah pelatih bisa datang ke rumah?',
                'jawaban' => 'Tentu saja. Kami menyediakan sesi di rumah dengan syarat kolam tersedia.',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'pertanyaan' => 'Apakah tersedia pelatih wanita?',
                'jawaban' => 'Ya, Anda bisa memilih pelatih sesuai kebutuhan dan kenyamanan.',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'pertanyaan' => 'Berapa durasi setiap sesi latihan?',
                'jawaban' => 'Durasi sesi umumnya 60–90 menit, tergantung program yang dipilih.',
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'pertanyaan' => 'Apakah saya bisa memilih jadwal sendiri?',
                'jawaban' => 'Ya, Anda dapat memilih hari dan jam sesuai dengan ketersediaan Anda dan pelatih.',
                'urutan' => 4,
                'is_active' => true,
            ],
            [
                'pertanyaan' => 'Apakah program tersedia untuk segala usia?',
                'jawaban' => 'Program kami tersedia untuk anak-anak hingga dewasa, mulai usia 4 tahun ke atas.',
                'urutan' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['pertanyaan' => $faq['pertanyaan']],
                $faq
            );
        }
    }
}