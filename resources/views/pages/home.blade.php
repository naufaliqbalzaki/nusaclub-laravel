@extends('layouts.app')

@section('title', 'NusaClub Gresik')
@section('meta_description', 'Les privat renang profesional dan menyenangkan di Gresik. Pelatih bersertifikat, jadwal fleksibel, hasil maksimal.')

@section('content')
@php
    $heroTitle = \App\Models\Setting::getValue('hero_title', 'Les Privat Renang');
    $heroDescription = \App\Models\Setting::getValue('hero_description', 'Saatnya kamu mulai belajar renang dengan cara yang lebih fleksibel dan efektif. Kami sediakan pelatih berkualitas, waktu latihan yang bisa kamu pilih sendiri, dan lingkungan yang mendukung kemajuanmu. Daftar sekarang dan rasakan sendiri bedanya!');
    $ctaTitle = \App\Models\Setting::getValue('cta_title', 'Mulai langkah pertamamu bersama NusaClub');
    $ctaSubtitle = \App\Models\Setting::getValue('cta_subtitle', 'Jadilah bagian dari ratusan peserta yang telah berkembang bersama pelatih terbaik kami.');
@endphp

<section id="hero" class="hero-edubia fade-in">
    <div class="hero-container">
        <div class="hero-text">
            <h1>{{ $heroTitle }}</h1>
            <img src="{{ asset('assets/images/Swim-rafiki.svg') }}" alt="Ilustrasi Renang" class="hero-inline-image">
            <p>{{ $heroDescription }}</p>
            <div class="hero-buttons">
                <a href="#contact" class="btn btn-filled">Daftar Sekarang</a>
            </div>
        </div>
        <div class="hero-visual">
            <img src="{{ asset('assets/images/Swim-rafiki.svg') }}" alt="Ilustrasi Renang" class="hero-image">
        </div>
    </div>
</section>

<section class="section stats fade-in">
    <div class="container">
        <h2 class="section-title">Statistik Kami</h2>
        <p class="section-subtitle">Beberapa angka yang mencerminkan kualitas layanan kami</p>
        <div class="card-grid">
            <div class="stat-box">
                <h3 class="counter" data-target="{{ $stats['students_count'] }}">0</h3>
                <p>Peserta Les</p>
            </div>
            <div class="stat-box">
                <h3 class="counter" data-target="{{ $stats['coaches_count'] }}">0</h3>
                <p>Pelatih Profesional</p>
            </div>
            <div class="stat-box">
                <h3 class="counter" data-target="{{ $stats['years_experience'] }}">0</h3>
                <p>Tahun Pengalaman</p>
            </div>
        </div>
    </div>
</section>

<section id="benefits" class="section benefits fade-in">
    <div class="container">
        <h2 class="section-title">Keunggulan dan Benefit</h2>
        <p class="section-subtitle">Mengapa memilih kami sebagai mitra renang Anda?</p>
        <div class="card-grid">
            <div class="card">
                <img src="https://cdn-icons-png.flaticon.com/512/201/201623.png" class="icon" alt="Jadwal Fleksibel">
                <h3>Jadwal Fleksibel</h3>
                <p>Tentukan sendiri hari dan jam belajar sesuai kebutuhan Anda.</p>
            </div>
            <div class="card">
                <img src="https://cdn-icons-png.flaticon.com/512/4140/4140047.png" class="icon" alt="One-on-One">
                <h3>One-on-One</h3>
                <p>Pelatih fokus kepada 1 murid dalam setiap sesi untuk hasil maksimal.</p>
            </div>
            <div class="card">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828640.png" class="icon" alt="Pelatih Bersertifikat">
                <h3>Pelatih Bersertifikat</h3>
                <p>Pelatih berpengalaman dan tersertifikasi untuk semua usia dan level.</p>
            </div>
        </div>
    </div>
</section>

<section id="program" class="section program-section fade-in">
    <div class="container">
        <h2 class="section-title">Pilih Program Sesuai Level Anda</h2>
        <p class="section-subtitle">Kami menyediakan kurikulum bertahap agar Anda bisa belajar dengan nyaman dan terarah.</p>

        <div class="program-cards">
            <div class="program-card beginner">
                <div class="program-badge">Beginner 🐣</div>
                <h3>Dasar Renang</h3>
                <ul>
                    <li>Penguasaan air & pernapasan</li>
                    <li>Keseimbangan tubuh</li>
                    <li>Latihan keselamatan</li>
                </ul>
            </div>

            <div class="program-card intermediate">
                <div class="program-badge">Intermediate 🏊</div>
                <h3>Teknik Menengah</h3>
                <ul>
                    <li>Gaya dada & punggung</li>
                    <li>Koordinasi gerakan</li>
                    <li>Peningkatan stamina</li>
                </ul>
            </div>

            <div class="program-card advanced">
                <div class="program-badge">Advanced 🔥</div>
                <h3>Kompetisi & Profesional</h3>
                <ul>
                    <li>Gaya bebas & butterfly</li>
                    <li>Latihan endurance</li>
                    <li>Simulasi kompetisi</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="profil" class="section profil-pelatih fade-in">
    <div class="container">
        <div class="section-heading-premium">
            <span class="section-kicker">Tim Profesional Kami</span>
            <h2 class="section-title">Kenali Pelatih Kami</h2>
            <p class="section-subtitle">
                Pelatih NusaClub hadir dengan pendekatan yang ramah, terarah, dan fokus pada perkembangan peserta di setiap level.
            </p>
        </div>

        @if ($coaches->count())
            <div class="coach-slider-shell">
                <button class="coach-slider-btn coach-slider-btn-prev" type="button" aria-label="Geser ke kiri">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="coach-slider-viewport">
                    <div class="coach-slider-track">
                        @foreach ($coaches as $coach)
                            <div class="coach-slide">
                                <div class="coach-card-premium">
                                    <div class="coach-image-wrap">
                                        <img src="{{ $coach->photo_url ?? asset('assets/images/random.jpg') }}" alt="Pelatih {{ $coach->nama }}">
                                        <div class="coach-image-overlay"></div>
                                        <span class="coach-badge">Pelatih Profesional</span>
                                    </div>

                                    <div class="coach-content">
                                        <div class="coach-name-area">
                                            <h3 class="coach-name">{{ $coach->nama }}</h3>
                                            <p class="coach-role">{{ $coach->jabatan }}</p>
                                        </div>

                                        <p class="coach-description">
                                            {{ $coach->deskripsi ?: 'Pelatih renang NusaClub yang siap mendampingi peserta dengan metode latihan yang menyenangkan, aman, dan progresif.' }}
                                        </p>

                                        <div class="coach-footer">
                                            <div class="coach-socials-premium">
                                                @if ($coach->instagram)
                                                    <a href="{{ $coach->instagram }}" target="_blank" class="coach-social-link" aria-label="Instagram">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                @endif

                                                @if ($coach->twitter)
                                                    <a href="{{ $coach->twitter }}" target="_blank" class="coach-social-link" aria-label="Twitter">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                @endif

                                                @if ($coach->linkedin)
                                                    <a href="{{ $coach->linkedin }}" target="_blank" class="coach-social-link" aria-label="LinkedIn">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>
                                                @endif
                                            </div>

                                            <span class="coach-status-chip">Aktif</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button class="coach-slider-btn coach-slider-btn-next" type="button" aria-label="Geser ke kanan">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        @else
            <div class="coach-empty-state">
                Belum ada data pelatih.
            </div>
        @endif
    </div>
</section>

<section id="jadwal" class="section jadwal-section fade-in">
    <div class="container">
        <h2 class="section-title">Jadwal Kelas & Harga Paket</h2>
        <p class="section-subtitle">Pilih kelas sesuai usia dan kebutuhanmu. Harga sudah termasuk tiket masuk dan pengantar!</p>

        <div class="paket-grid">
            <div class="paket-card reguler" data-badge="Paling Laris">
                <div class="paket-header">
                    <h3>📘 Paket Reguler</h3>
                    <p class="paket-price">Rp275.000 / 4x</p>
                    <small class="paket-note">+ Pendaftaran Rp50.000 (Free Kacamata)</small>
                </div>
                <ul class="paket-info">
                    <li>👧 Usia TK A – Kelas 1 SD</li>
                    <li>🎫 Tiket anak & 1 pengantar</li>
                    <li>📅 Selasa – Kamis, 14.00 WIB</li>
                    <li>📅 Jumat & Sabtu, 15.00 WIB</li>
                    <li>👨‍🏫 1 Pelatih : Max 4 anak</li>
                </ul>
                <a href="{{ route('daftar') }}" class="btn">Daftar Sekarang</a>
            </div>

            <div class="paket-card privat" data-badge="Privat Eksklusif">
                <div class="paket-header">
                    <h3>👤 Paket Privat</h3>
                    <p class="paket-price">Rp150.000 / sesi</p>
                    <small class="paket-note">Tiket anak & 1 pengantar sudah termasuk</small>
                </div>
                <ul class="paket-info">
                    <li>🧒 Usia TK – SMA</li>
                    <li>📍 Hari Minggu (khusus)</li>
                    <li>🕘 Sesi 1: 09.00 WIB</li>
                    <li>🕥 Sesi 2: 10.15 WIB</li>
                    <li>🎯 One-on-One Coaching</li>
                </ul>
                <a href="{{ route('daftar') }}" class="btn">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</section>

<section id="testimoni" class="section testimoni-section fade-in">
    <div class="container">
        <h2 class="section-title">Testimoni Peserta</h2>
        <p class="section-subtitle">Apa kata peserta kami tentang pengalaman belajar di NusaClub?</p>

        @if (session('success_testimonial'))
            <div class="daftar-alert daftar-alert-success" style="max-width:900px; margin:0 auto 1.5rem;">
                <i class="fas fa-circle-check"></i>
                <div>
                    <strong>Testimoni berhasil dikirim.</strong>
                    <p style="margin:4px 0 0;">{{ session('success_testimonial') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->has('nama') || $errors->has('isi') || $errors->has('rating'))
            <div class="daftar-alert daftar-alert-error" style="max-width:900px; margin:0 auto 1.5rem;">
                <i class="fas fa-circle-exclamation"></i>
                <div>
                    <strong>Gagal mengirim testimoni.</strong>
                    <ul style="margin:8px 0 0; padding-left:18px;">
                        @if ($errors->has('nama'))
                            <li>{{ $errors->first('nama') }}</li>
                        @endif
                        @if ($errors->has('isi'))
                            <li>{{ $errors->first('isi') }}</li>
                        @endif
                        @if ($errors->has('rating'))
                            <li>{{ $errors->first('rating') }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        @endif

        @php
            $loopTestimonials = $testimonials->count() ? $testimonials->concat($testimonials) : collect();
        @endphp

        <div class="testimonial-slider">
            <div class="testimonial-track">
                @forelse ($loopTestimonials as $testimonial)
                    <div class="testimonial-slide">
                        <div class="testimoni-card">
                            <p class="testimoni-text">"{{ $testimonial->isi }}"</p>
                            <p class="testimoni-author">- {{ $testimonial->nama }}</p>
                            <p class="testimoni-rating">
                                Rating: {{ str_repeat('★', $testimonial->rating) }}{{ str_repeat('☆', 5 - $testimonial->rating) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="testimonial-slide">
                        <div class="testimoni-card">
                            <p class="testimoni-text">"Sangat menyenangkan belajar di sini, pelatihnya sabar dan mudah dipahami!"</p>
                            <p class="testimoni-author">- NusaClub</p>
                            <p class="testimoni-rating">Rating: ★★★★★</p>
                        </div>
                    </div>
                    <div class="testimonial-slide">
                        <div class="testimoni-card">
                            <p class="testimoni-text">"Jadwal fleksibel dan komunikasinya sangat baik. Anak jadi lebih semangat latihan."</p>
                            <p class="testimoni-author">- Orang Tua Siswa</p>
                            <p class="testimoni-rating">Rating: ★★★★★</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="testimoni-button" style="margin-top: 2rem; text-align:center;">
            <button id="addTestimoniBtn" class="btn btn-filled" type="button">
                Tambah Testimoni
            </button>
        </div>
    </div>
</section>

<div id="testimoniModal" class="modal">
    <div class="modal-content">
        <span id="closeModalBtn" class="close-btn">&times;</span>
        <h2>Tambahkan Testimoni</h2>

        <form id="testimoniForm" action="{{ route('testimonials.public.store') }}" method="POST">
            @csrf

            <label for="name">Nama:</label>
            <input type="text" id="name" name="nama" value="{{ old('nama') }}" required>

            <label for="testimoniText">Testimoni:</label>
            <textarea id="testimoniText" name="isi" rows="4" required>{{ old('isi') }}</textarea>

            <label>Rating:</label>
            <div class="rating-input">
                <input type="radio" id="rating-5" name="rating" value="5" {{ old('rating') == 5 ? 'checked' : '' }}>
                <label for="rating-5">★</label>

                <input type="radio" id="rating-4" name="rating" value="4" {{ old('rating') == 4 ? 'checked' : '' }}>
                <label for="rating-4">★</label>

                <input type="radio" id="rating-3" name="rating" value="3" {{ old('rating') == 3 ? 'checked' : '' }}>
                <label for="rating-3">★</label>

                <input type="radio" id="rating-2" name="rating" value="2" {{ old('rating') == 2 ? 'checked' : '' }}>
                <label for="rating-2">★</label>

                <input type="radio" id="rating-1" name="rating" value="1" {{ old('rating') == 1 ? 'checked' : '' }}>
                <label for="rating-1">★</label>
            </div>

            <button type="submit">Kirim Testimoni</button>
        </form>
    </div>
</div>

<section id="faq" class="section faq faq-premium-section fade-in">
    <div class="container">
        <div class="section-heading-premium">
            <span class="section-kicker">Pertanyaan Populer</span>
            <h2 class="section-title">Pertanyaan Umum</h2>
            <p class="section-subtitle">Temukan jawaban singkat untuk hal-hal yang paling sering ditanyakan sebelum mulai bergabung bersama NusaClub.</p>
        </div>

        <div class="faq-premium-wrap">
            @forelse ($faqs as $faq)
                <div class="faq-item faq-item-premium">
                    <button class="faq-question faq-question-premium">
                        <div class="faq-question-left">
                            <span class="faq-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="faq-question-text">{{ $faq->pertanyaan }}</span>
                        </div>
                        <span class="faq-icon-wrap">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </button>
                    <div class="faq-answer faq-answer-premium">
                        {{ $faq->jawaban }}
                    </div>
                </div>
            @empty
                <div class="faq-item faq-item-premium">
                    <button class="faq-question faq-question-premium">
                        <div class="faq-question-left">
                            <span class="faq-number">01</span>
                            <span class="faq-question-text">Apakah pelatih bisa datang ke rumah?</span>
                        </div>
                        <span class="faq-icon-wrap">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </button>
                    <div class="faq-answer faq-answer-premium">
                        Tentu saja. Kami menyediakan sesi di rumah dengan syarat kolam tersedia.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section id="contact" class="cta-block fade-in">
    <div class="container">
        <img src="https://cdn-icons-png.flaticon.com/512/3534/3534060.png" alt="Ikon CTA" class="cta-icon" />
        <h2 class="cta-title">{{ $ctaTitle }}</h2>
        <p class="cta-subtitle">{{ $ctaSubtitle }}</p>
        <div class="cta-buttons">
            <a href="{{ route('daftar') }}" class="btn btn-filled btn-cta">Daftar Sekarang</a>
        </div>
    </div>
</section>
@endsection