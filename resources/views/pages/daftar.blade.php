@extends('layouts.app')

@section('title', 'Form Pendaftaran Online - NusaClub')
@section('meta_description', 'Form pendaftaran online les renang NusaClub.')

@section('content')
<section class="daftar-premium-section fade-in">
    <div class="container">
        <div class="daftar-premium-header">
            <span class="section-kicker">Pendaftaran NusaClub</span>
            <h1 class="daftar-premium-title">Form Pendaftaran Online</h1>
            <p class="daftar-premium-subtitle">
                Isi formulir berikut untuk memulai perjalanan belajar renang bersama pelatih terbaik NusaClub.
            </p>
        </div>

        @if (session('success'))
            <div class="daftar-alert daftar-alert-success">
                <i class="fas fa-circle-check"></i>
                <div>
                    <strong>Pendaftaran berhasil dikirim.</strong>
                    <p style="margin:4px 0 0;">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="daftar-alert daftar-alert-error">
                <i class="fas fa-circle-exclamation"></i>
                <div>
                    <strong>Mohon periksa kembali form Anda.</strong>
                    <ul style="margin:8px 0 0; padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="daftar-premium-grid">
            <div class="daftar-form-card">
                <div class="daftar-form-card-head">
                    <h2>Isi Data Pendaftaran</h2>
                    <p>Pastikan data yang Anda masukkan sudah benar agar tim kami dapat segera menghubungi Anda.</p>
                </div>

                <form action="{{ route('daftar.store') }}" method="POST" class="daftar-premium-form">
                    @csrf

                    <div class="daftar-field-grid">
                        <label class="daftar-field">
                            <span>Nama Lengkap</span>
                            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Alya Putri" required>
                        </label>

                        <label class="daftar-field">
                            <span>Nomor WhatsApp</span>
                            <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="08xxxxxxxxxx" required>
                        </label>
                    </div>

                    <div class="daftar-field-grid">
                        <label class="daftar-field">
                            <span>Usia</span>
                            <input type="number" name="usia" min="4" value="{{ old('usia') }}" placeholder="Contoh: 8" required>
                        </label>

                        <label class="daftar-field">
                            <span>Pilihan Program</span>
                            <select name="program_id">
                                <option value="">-- Pilih Program --</option>
                                @forelse ($programs as $program)
                                    <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                        {{ $program->nama }}
                                    </option>
                                @empty
                                    <option value="" disabled>Program belum tersedia</option>
                                @endforelse
                            </select>
                        </label>
                    </div>

                    <label class="daftar-field">
                        <span>Jadwal Kelas & Harga Paket</span>
                        <select name="package_id">
                            <option value="">-- Pilih Paket --</option>
                            @forelse ($packages as $package)
                                <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                    {{ $package->nama }}
                                    @if ($package->program)
                                        - {{ $package->program->nama }}
                                    @endif
                                    - Rp{{ number_format($package->harga, 0, ',', '.') }}
                                    @if ($package->durasi)
                                        / {{ $package->durasi }}
                                    @endif
                                </option>
                            @empty
                                <option value="" disabled>Paket belum tersedia</option>
                            @endforelse
                        </select>
                    </label>

                    <label class="daftar-field">
                        <span>Lokasi Belajar</span>
                        <select name="location_id" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @forelse ($locations as $location)
                                <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                    {{ $location->nama }}
                                </option>
                            @empty
                                <option value="" disabled>Lokasi belum tersedia</option>
                            @endforelse
                        </select>
                    </label>

                    <label class="daftar-field">
                        <span>Catatan Tambahan</span>
                        <textarea name="catatan" rows="5" placeholder="Tulis kebutuhan khusus, target belajar, atau informasi tambahan lainnya">{{ old('catatan') }}</textarea>
                    </label>

                    <div class="daftar-form-actions-premium">
                        <button type="submit" class="btn btn-filled daftar-submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Pendaftaran
                        </button>

                        <a href="{{ route('home') }}" class="btn btn-outline daftar-back-btn">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </form>
            </div>

            <aside class="daftar-info-card">
                <div class="daftar-info-top">
                    <span class="daftar-info-badge">Kenapa daftar sekarang?</span>
                    <h3>Mulai lebih cepat, progres lebih terasa</h3>
                    <p>
                        Dengan jadwal fleksibel dan pelatih profesional, NusaClub membantu peserta belajar renang
                        secara aman, terarah, dan menyenangkan.
                    </p>
                </div>

                <div class="daftar-feature-list">
                    <div class="daftar-feature-item">
                        <div class="daftar-feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <h4>Jadwal Fleksibel</h4>
                            <p>Pilih waktu latihan yang sesuai dengan aktivitas harian Anda.</p>
                        </div>
                    </div>

                    <div class="daftar-feature-item">
                        <div class="daftar-feature-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <h4>Pelatih Berpengalaman</h4>
                            <p>Dibimbing oleh pelatih yang fokus pada progres dan kenyamanan peserta.</p>
                        </div>
                    </div>

                    <div class="daftar-feature-item">
                        <div class="daftar-feature-icon">
                            <i class="fas fa-water"></i>
                        </div>
                        <div>
                            <h4>Program Bertahap</h4>
                            <p>Cocok untuk pemula hingga peserta yang ingin meningkatkan teknik renang.</p>
                        </div>
                    </div>
                </div>

                <div class="daftar-contact-box">
                    <h4>Butuh bantuan sebelum mendaftar?</h4>
                    <p>Tim kami siap membantu memberikan informasi program dan jadwal terbaik untuk Anda.</p>
                    <a href="{{ \App\Models\Setting::getValue('whatsapp_url', 'https://wa.me/6281234049926') }}" target="_blank" class="btn btn-filled">
                        <i class="fab fa-whatsapp"></i>
                        Chat via WhatsApp
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection