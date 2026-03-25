<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'nama' => 'Andi Pratama',
                'isi' => 'Belajarnya menyenangkan dan pelatihnya sabar banget. Anak saya jadi lebih percaya diri di kolam.',
                'rating' => 5,
                'status' => 'approved',
                'is_featured' => true,
            ],
            [
                'nama' => 'Siti Rahma',
                'isi' => 'Jadwal fleksibel dan komunikasinya enak. Sangat membantu untuk orang tua yang punya jadwal padat.',
                'rating' => 5,
                'status' => 'approved',
                'is_featured' => false,
            ],
            [
                'nama' => 'Budi Santoso',
                'isi' => 'Pelatihnya fokus dan teknik yang diajarkan mudah dipahami. Progress terasa dalam beberapa pertemuan.',
                'rating' => 4,
                'status' => 'approved',
                'is_featured' => false,
            ],
            [
                'nama' => 'Rina Maharani',
                'isi' => 'Awalnya takut air, sekarang anak saya sudah berani dan mulai bisa gaya dada dasar.',
                'rating' => 5,
                'status' => 'approved',
                'is_featured' => true,
            ],
            [
                'nama' => 'Dewi Lestari',
                'isi' => 'Cocok untuk pemula maupun yang ingin serius latihan. Tempat dan suasananya juga nyaman.',
                'rating' => 4,
                'status' => 'approved',
                'is_featured' => false,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                [
                    'nama' => $testimonial['nama'],
                    'isi' => $testimonial['isi'],
                ],
                $testimonial
            );
        }
    }
}