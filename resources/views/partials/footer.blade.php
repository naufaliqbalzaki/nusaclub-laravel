@php
    $siteName = \App\Models\Setting::getValue('site_name', 'NusaClub');
    $contactPhone = \App\Models\Setting::getValue('contact_phone', '0816-359-465');
    $contactEmail = \App\Models\Setting::getValue('contact_email', 'info@renanggresik.com');
    $contactAddress = \App\Models\Setting::getValue('contact_address', 'Jl. Rantau I No.27-29, Wonorejo, Yosowilangun, Manyar, Gresik 61151');
    $instagramUrl = \App\Models\Setting::getValue('instagram_url', 'https://www.instagram.com/renang_nusaclub');
    $youtubeUrl = \App\Models\Setting::getValue('youtube_url', 'https://youtube.com/@renanggresik');
    $mapsUrl = \App\Models\Setting::getValue('maps_url', 'https://g.co/kgs/QPAzcnh');
    $tiktokUrl = \App\Models\Setting::getValue('tiktok_url', 'https://www.tiktok.com/@renanggresik');
    $whatsappUrl = \App\Models\Setting::getValue('whatsapp_url', 'https://wa.me/6281234049926');
@endphp

<footer class="footer fade-in">
    <div class="container footer-grid">
        <div class="footer-col footer-brand">
            <img src="{{ asset('assets/images/Logo.jpg') }}" alt="Logo {{ $siteName }}" class="footer-logo" />
            <h3>{{ $siteName }}</h3>
            <p>Solusi belajar renang terbaik di Gresik</p>
            <div class="social-icons">
                <a href="{{ $instagramUrl }}" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="{{ $youtubeUrl }}" target="_blank" aria-label="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="{{ $mapsUrl }}" target="_blank" aria-label="Google Maps">
                    <i class="fas fa-map-marker-alt"></i>
                </a>
                <a href="{{ $tiktokUrl }}" target="_blank" aria-label="TikTok">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
        </div>

        <div class="footer-col footer-links">
            <h4>Menu</h4>
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('home') }}#program">Program</a></li>
                <li><a href="{{ route('home') }}#benefits">Keunggulan</a></li>
                <li><a href="{{ route('home') }}#faq">FAQ</a></li>
                <li><a href="{{ route('home') }}#contact">Kontak</a></li>
            </ul>
        </div>

        <div class="footer-col footer-contact">
            <h4>Hubungi Kami</h4>
            <ul>
                <li>
                    <i class="fas fa-phone-alt"></i>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}">
                        {{ $contactPhone }}
                    </a>
                </li>
                <li>
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:{{ $contactEmail }}">
                        {{ $contactEmail }}
                    </a>
                </li>
                <li>
                    <i class="fas fa-map-marked-alt"></i>
                    {{ $contactAddress }}
                </li>
            </ul>
        </div>
    </div>

    <div class="footer-copy">
        &copy; {{ now()->year }} <strong>{{ $siteName }}</strong>. All rights reserved.
    </div>
</footer>

<a href="{{ $whatsappUrl }}" class="btn-whatsapp" target="_blank" aria-label="Chat WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>