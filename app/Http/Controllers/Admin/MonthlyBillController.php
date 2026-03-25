<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MonthlyBillRequest;
use App\Models\MonthlyBill;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonthlyBillController extends Controller
{
    public function index(Request $request): View
    {
        $query = MonthlyBill::with(['student', 'package'])->latest();

        if ($request->filled('bill_month')) {
            $query->where('bill_month', $request->bill_month);
        }

        if ($request->filled('bill_year')) {
            $query->where('bill_year', $request->bill_year);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bills = $query->paginate(10)->withQueryString();

        return view('admin.bills.index', compact('bills'));
    }

    public function create(): View
    {
        $students = Student::with(['program', 'package'])
            ->where('status', 'aktif')
            ->latest()
            ->get();

        return view('admin.bills.create', compact('students'));
    }

    public function store(MonthlyBillRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $student = Student::findOrFail($validated['student_id']);
        $diskon = $validated['diskon'] ?? 0;
        $total = max(0, $validated['nominal'] - $diskon);

        MonthlyBill::create([
            'student_id' => $student->id,
            'package_id' => $student->package_id,
            'bill_month' => $validated['bill_month'],
            'bill_year' => $validated['bill_year'],
            'nominal' => $validated['nominal'],
            'diskon' => $diskon,
            'total' => $total,
            'jatuh_tempo' => $validated['jatuh_tempo'],
            'status' => 'belum_bayar',
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()->route('admin.bills.index')->with('success', 'Tagihan berhasil ditambahkan.');
    }

    public function edit(MonthlyBill $monthlyBill): View
    {
        $students = Student::with(['program', 'package'])
            ->where('status', 'aktif')
            ->latest()
            ->get();

        return view('admin.bills.edit', compact('monthlyBill', 'students'));
    }

    public function update(MonthlyBillRequest $request, MonthlyBill $monthlyBill): RedirectResponse
    {
        $validated = $request->validated();

        $student = Student::findOrFail($validated['student_id']);
        $diskon = $validated['diskon'] ?? 0;
        $total = max(0, $validated['nominal'] - $diskon);

        $monthlyBill->update([
            'student_id' => $student->id,
            'package_id' => $student->package_id,
            'bill_month' => $validated['bill_month'],
            'bill_year' => $validated['bill_year'],
            'nominal' => $validated['nominal'],
            'diskon' => $diskon,
            'total' => $total,
            'jatuh_tempo' => $validated['jatuh_tempo'],
            'status' => $validated['status'] ?? $monthlyBill->status,
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()->route('admin.bills.index')->with('success', 'Tagihan berhasil diperbarui.');
    }

    public function destroy(MonthlyBill $monthlyBill): RedirectResponse
    {
        $monthlyBill->delete();

        return redirect()->route('admin.bills.index')->with('success', 'Tagihan berhasil dihapus.');
    }

    public function generate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'bill_month' => ['required', 'integer', 'between:1,12'],
            'bill_year' => ['required', 'integer', 'min:2024'],
            'jatuh_tempo' => ['required', 'date'],
        ]);

        $students = Student::with('package')
            ->where('status', 'aktif')
            ->whereNotNull('package_id')
            ->get()
            ->filter(function ($student) {
                return $student->package && $student->package->tipe_tagihan === 'monthly';
            });

        $created = 0;

        foreach ($students as $student) {
            $exists = MonthlyBill::where('student_id', $student->id)
                ->where('bill_month', $validated['bill_month'])
                ->where('bill_year', $validated['bill_year'])
                ->exists();

            if ($exists) {
                continue;
            }

            MonthlyBill::create([
                'student_id' => $student->id,
                'package_id' => $student->package_id,
                'bill_month' => $validated['bill_month'],
                'bill_year' => $validated['bill_year'],
                'nominal' => $student->package->harga,
                'diskon' => 0,
                'total' => $student->package->harga,
                'jatuh_tempo' => $validated['jatuh_tempo'],
                'status' => 'belum_bayar',
                'catatan' => 'Generate otomatis tagihan bulanan',
            ]);

            $created++;
        }

        return redirect()->route('admin.bills.index')->with('success', "Generate tagihan selesai. {$created} tagihan baru dibuat.");
    }
}