@extends('admin.layouts.app')

@section('title', 'Konten Website')

@section('content')
@if ($errors->any())
    <div class="admin-alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.settings.store') }}" method="POST">
    @csrf

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:24px;">
        <div class="table-card" style="margin-bottom:0;">
            <h3 style="margin-bottom:18px;">Identitas Website</h3>

            <div class="daftar-form">
                <label>Nama Website
                    <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}">
                </label>

                <label>Hero Title
                    <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title']) }}">
                </label>

                <label>Hero Description
                    <textarea name="hero_description" rows="5">{{ old('hero_description', $settings['hero_description']) }}</textarea>
                </label>

                <label>CTA Title
                    <input type="text" name="cta_title" value="{{ old('cta_title', $settings['cta_title']) }}">
                </label>

                <label>CTA Subtitle
                    <textarea name="cta_subtitle" rows="4">{{ old('cta_subtitle', $settings['cta_subtitle']) }}</textarea>
                </label>

                <label>Tahun Pengalaman
                    <input type="number" name="years_experience" value="{{ old('years_experience', $settings['years_experience']) }}">
                </label>
            </div>
        </div>

        <div class="table-card" style="margin-bottom:0;">
            <h3 style="margin-bottom:18px;">Kontak & Lokasi</h3>

            <div class="daftar-form">
                <label>Nomor Telepon
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']) }}">
                </label>

                <label>Email
                    <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}">
                </label>

                <label>Alamat
                    <textarea name="contact_address" rows="5">{{ old('contact_address', $settings['contact_address']) }}</textarea>
                </label>

                <label>WhatsApp URL
                    <input type="url" name="whatsapp_url" value="{{ old('whatsapp_url', $settings['whatsapp_url']) }}">
                </label>

                <label>Google Maps URL
                    <input type="url" name="maps_url" value="{{ old('maps_url', $settings['maps_url']) }}">
                </label>
            </div>
        </div>
    </div>

    <div class="table-card">
        <h3 style="margin-bottom:18px;">Media Sosial</h3>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:18px;">
            <label>Instagram URL
                <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url']) }}">
            </label>

            <label>YouTube URL
                <input type="url" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url']) }}">
            </label>

            <label>TikTok URL
                <input type="url" name="tiktok_url" value="{{ old('tiktok_url', $settings['tiktok_url']) }}">
            </label>
        </div>
    </div>

    <div class="table-card">
        <div class="admin-filterbar" style="margin-bottom:0;">
            <div>
                <h3 style="margin-bottom:6px;">Simpan Perubahan</h3>
                <p style="margin:0; color:var(--admin-muted);">Pastikan semua data website sudah sesuai sebelum disimpan.</p>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <button type="submit" class="btn btn-filled" style="padding:14px 20px; border:none;">
                    <i class="fas fa-floppy-disk"></i>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</form>
@endsection