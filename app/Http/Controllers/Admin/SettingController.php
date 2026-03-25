<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = [
            'site_name' => Setting::getValue('site_name', 'NusaClub'),
            'hero_title' => Setting::getValue('hero_title', 'Les Privat Renang Terbaik di Gresik'),
            'hero_description' => Setting::getValue('hero_description', 'Saatnya kamu mulai belajar renang dengan cara yang lebih fleksibel dan efektif.'),
            'cta_title' => Setting::getValue('cta_title', 'Mulai langkah pertamamu bersama NusaClub'),
            'cta_subtitle' => Setting::getValue('cta_subtitle', 'Jadilah bagian dari ratusan peserta yang telah berkembang bersama pelatih terbaik kami.'),
            'years_experience' => Setting::getValue('years_experience', '8'),
            'contact_phone' => Setting::getValue('contact_phone', '0816-359-465'),
            'contact_email' => Setting::getValue('contact_email', 'info@renanggresik.com'),
            'contact_address' => Setting::getValue('contact_address', 'Jl. Rantau I No.27-29, Wonorejo, Yosowilangun, Manyar, Gresik 61151'),
            'instagram_url' => Setting::getValue('instagram_url', 'https://www.instagram.com/renang_nusaclub'),
            'youtube_url' => Setting::getValue('youtube_url', 'https://youtube.com/@renanggresik'),
            'tiktok_url' => Setting::getValue('tiktok_url', 'https://www.tiktok.com/@renanggresik'),
            'maps_url' => Setting::getValue('maps_url', 'https://g.co/kgs/QPAzcnh'),
            'whatsapp_url' => Setting::getValue('whatsapp_url', 'https://wa.me/6281234049926'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],
            'cta_title' => ['nullable', 'string', 'max:255'],
            'cta_subtitle' => ['nullable', 'string'],
            'years_experience' => ['nullable', 'integer', 'min:0'],
            'contact_phone' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email'],
            'contact_address' => ['nullable', 'string'],
            'instagram_url' => ['nullable', 'url'],
            'youtube_url' => ['nullable', 'url'],
            'tiktok_url' => ['nullable', 'url'],
            'maps_url' => ['nullable', 'url'],
            'whatsapp_url' => ['nullable', 'url'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::setValue($key, $value);
        }

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Konten website berhasil diperbarui.');
    }
}