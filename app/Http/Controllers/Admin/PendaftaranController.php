<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PendaftaransExport;
use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PendaftaranController extends Controller
{
    public function index(Request $request): View
    {
        $query = Pendaftaran::with(['program', 'student'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('whatsapp', 'like', "%{$keyword}%")
                  ->orWhere('lokasi', 'like', "%{$keyword}%");
            });
        }

        $pendaftarans = $query->paginate(10)->withQueryString();

        return view('admin.pendaftarans.index', compact('pendaftarans'));
    }

    public function updateStatus(Request $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:baru,dihubungi,trial,diterima,aktif,batal'],
        ]);

        $pendaftaran->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function convertToStudent(Pendaftaran $pendaftaran): RedirectResponse
    {
        $student = Student::firstOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'nama' => $pendaftaran->nama,
                'whatsapp' => $pendaftaran->whatsapp,
                'usia' => $pendaftaran->usia,
                'alamat' => $pendaftaran->location?->nama ?? $pendaftaran->lokasi,
                'program_id' => $pendaftaran->program_id,
                'package_id' => $pendaftaran->package_id,
                'location_id' => $pendaftaran->location_id,
                'tanggal_mulai' => now()->toDateString(),
                'status' => 'aktif',
                'catatan' => $pendaftaran->catatan,
            ]
        );

        $pendaftaran->update([
            'status' => 'aktif',
        ]);

        return redirect()
            ->route('admin.students.edit', $student)
            ->with('success', 'Pendaftaran berhasil dikonversi menjadi siswa. Silakan lengkapi data lainnya.');
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(
            new PendaftaransExport,
            'pendaftarans-' . now()->format('Y-m-d') . '.xlsx',
            ExcelFormat::XLSX
        );
    }
}