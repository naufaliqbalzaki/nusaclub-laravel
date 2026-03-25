<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Models\Package;
use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(): View
    {
        $packages = Package::with('program')->latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function create(): View
    {
        $programs = Program::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.packages.create', compact('programs'));
    }

    public function store(PackageRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        Package::create($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(Package $package): View
    {
        $programs = Program::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.packages.edit', compact('package', 'programs'));
    }

    public function update(PackageRequest $request, Package $package): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        $package->update($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Package $package): RedirectResponse
    {
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus.');
    }
}