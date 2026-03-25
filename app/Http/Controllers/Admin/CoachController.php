<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CoachController extends Controller
{
    public function index(): View
    {
        $coaches = Coach::latest()->paginate(10);
        return view('admin.coaches.index', compact('coaches'));
    }

    public function create(): View
    {
        return view('admin.coaches.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'instagram' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('coaches', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Coach::create($validated);

        return redirect()->route('admin.coaches.index')->with('success', 'Pelatih berhasil ditambahkan.');
    }

    public function edit(Coach $coach): View
    {
        return view('admin.coaches.edit', compact('coach'));
    }

    public function update(Request $request, Coach $coach): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'instagram' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('foto')) {
            if ($coach->foto) {
                Storage::disk('public')->delete($coach->foto);
            }

            $validated['foto'] = $request->file('foto')->store('coaches', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $coach->update($validated);

        return redirect()->route('admin.coaches.index')->with('success', 'Pelatih berhasil diperbarui.');
    }

    public function destroy(Coach $coach): RedirectResponse
    {
        if ($coach->foto) {
            Storage::disk('public')->delete($coach->foto);
        }

        $coach->delete();

        return redirect()->route('admin.coaches.index')->with('success', 'Pelatih berhasil dihapus.');
    }
}