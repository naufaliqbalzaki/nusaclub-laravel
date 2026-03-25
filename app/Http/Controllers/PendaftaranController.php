<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Package;
use App\Models\Pendaftaran;
use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    public function create(): View
    {
        $programs = Program::where('is_active', true)
            ->orderBy('urutan')
            ->get();

        $packages = Package::with('program')
            ->where('is_active', true)
            ->latest()
            ->get();

        $locations = Location::where('is_active', true)
            ->orderBy('nama')
            ->get();

        return view('pages.daftar', compact('programs', 'packages', 'locations'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:25'],
            'usia' => ['required', 'integer', 'min:4'],
            'program_id' => ['nullable', 'exists:programs,id'],
            'package_id' => ['nullable', 'exists:packages,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'catatan' => ['nullable', 'string'],
        ]);

        $validated['status'] = 'baru';
        $validated['lokasi'] = null;

        Pendaftaran::create($validated);

        return redirect()
            ->route('daftar')
            ->with('success', 'Pendaftaran berhasil dikirim. Tim NusaClub akan segera menghubungi Anda.');
    }
}