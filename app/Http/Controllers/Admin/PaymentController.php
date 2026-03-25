<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PaymentsExport;
use App\Http\Controllers\Controller;
use App\Models\MonthlyBill;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payment::with(['student', 'monthlyBill', 'receiver'])
            ->latest()
            ->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }

    public function create(Request $request): View
    {
        $bills = MonthlyBill::with(['student', 'payments'])
            ->withSum('payments', 'nominal_bayar')
            ->whereIn('status', ['belum_bayar', 'cicilan', 'lewat_jatuh_tempo'])
            ->latest()
            ->get();

        return view('admin.payments.create', compact('bills'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'monthly_bill_id' => ['required', 'exists:monthly_bills,id'],
            'tanggal_bayar' => ['required', 'date'],
            'nominal_bayar' => ['required', 'numeric', 'min:1'],
            'metode_pembayaran' => ['required', 'in:transfer,cash,qris'],
            'reference_no' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
            'bukti_bayar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $bill = MonthlyBill::findOrFail($validated['monthly_bill_id']);

        $buktiBayarPath = null;
        if ($request->hasFile('bukti_bayar')) {
            $buktiBayarPath = $request->file('bukti_bayar')->store('payments', 'public');
        }

        Payment::create([
            'monthly_bill_id' => $bill->id,
            'student_id' => $bill->student_id,
            'tanggal_bayar' => $validated['tanggal_bayar'],
            'nominal_bayar' => $validated['nominal_bayar'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'reference_no' => $validated['reference_no'] ?? null,
            'catatan' => $validated['catatan'] ?? null,
            'bukti_bayar' => $buktiBayarPath,
            'diterima_oleh' => auth()->id(),
        ]);

        $this->refreshBillStatus($bill);

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function destroy(Payment $payment): RedirectResponse
    {
        $bill = $payment->monthlyBill;

        if ($payment->bukti_bayar) {
            Storage::disk('public')->delete($payment->bukti_bayar);
        }

        $payment->delete();

        if ($bill) {
            $this->refreshBillStatus($bill->fresh());
        }

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(
            new PaymentsExport,
            'payments-' . now()->format('Y-m-d') . '.xlsx',
            ExcelFormat::XLSX
        );
    }

    private function refreshBillStatus(MonthlyBill $bill): void
    {
        $paid = $bill->payments()->sum('nominal_bayar');

        if ($paid >= $bill->total) {
            $bill->update(['status' => 'lunas']);
            return;
        }

        if ($paid > 0) {
            $bill->update(['status' => 'cicilan']);
            return;
        }

        if ($bill->jatuh_tempo && $bill->jatuh_tempo->isPast()) {
            $bill->update(['status' => 'lewat_jatuh_tempo']);
            return;
        }

        $bill->update(['status' => 'belum_bayar']);
    }
}