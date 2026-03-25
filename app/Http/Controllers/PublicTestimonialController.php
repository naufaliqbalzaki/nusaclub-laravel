<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PublicTestimonialController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string', 'max:1000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        Testimonial::create([
            'nama' => $validated['nama'],
            'isi' => $validated['isi'],
            'rating' => $validated['rating'],
            'status' => 'pending',
            'is_featured' => false,
        ]);

        return redirect()
            ->route('home', ['#testimoni'])
            ->with('success_testimonial', 'Terima kasih, testimoni Anda berhasil dikirim dan menunggu persetujuan admin.');
    }
}