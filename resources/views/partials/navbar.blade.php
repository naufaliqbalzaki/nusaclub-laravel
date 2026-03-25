@php
    $siteName = \App\Models\Setting::getValue('site_name', 'NusaClub');
@endphp

<header class="navbar">
    <div class="container nav-container">
        <a href="{{ route('home') }}" class="logo" style="text-decoration: none;">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo {{ $siteName }}" class="navbar-logo">
            <span>{{ $siteName }}</span>
        </a>

        <button class="nav-toggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}#hero">Beranda</a></li>
                <li><a href="{{ route('home') }}#benefits">Keunggulan</a></li>
                <li><a href="{{ route('home') }}#program">Program</a></li>
                <li><a href="{{ route('home') }}#faq">FAQ</a></li>
                <li><a href="{{ route('home') }}#contact">Kontak</a></li>
                <li><a href="{{ route('daftar') }}">Daftar</a></li>
            </ul>
        </nav>
    </div>
</header>