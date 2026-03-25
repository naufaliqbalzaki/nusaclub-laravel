<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MonthlyBill;
use App\Models\Payment;
use App\Models\Pendaftaran;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPendaftar = Pendaftaran::count();

        $pendaftarHariIni = Pendaftaran::whereDate('created_at', now()->toDateString())->count();

        $totalSiswaAktif = Student::where('status', 'aktif')->count();

        $tagihanBelumLunas = MonthlyBill::whereIn('status', [
            'belum_bayar',
            'cicilan',
            'lewat_jatuh_tempo',
        ])->count();

        $pembayaranBulanIni = Payment::whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('nominal_bayar');

        $totalTunggakan = MonthlyBill::whereIn('status', [
            'belum_bayar',
            'cicilan',
            'lewat_jatuh_tempo',
        ])->sum('total');

        $pendaftaranPerStatus = Pendaftaran::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $tagihanPerStatus = MonthlyBill::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $pendaftaranTerbaru = Pendaftaran::latest()->take(10)->get();

        $pembayaranTerbaru = Payment::with('student')->latest()->take(10)->get();

        return view('admin.dashboard.index', compact(
            'totalPendaftar',
            'pendaftarHariIni',
            'totalSiswaAktif',
            'tagihanBelumLunas',
            'pembayaranBulanIni',
            'totalTunggakan',
            'pendaftaranPerStatus',
            'tagihanPerStatus',
            'pendaftaranTerbaru',
            'pembayaranTerbaru'
        ));
    }
}