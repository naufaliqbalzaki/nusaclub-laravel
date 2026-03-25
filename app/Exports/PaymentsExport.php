<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection(): Collection
    {
        return Payment::with(['student', 'monthlyBill', 'receiver'])
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Siswa',
            'Periode',
            'Tanggal Bayar',
            'Nominal',
            'Metode',
            'Reference No',
            'Diterima Oleh',
        ];
    }

    public function map($payment): array
    {
        return [
            $payment->id,
            $payment->student?->nama ?? '-',
            ($payment->monthlyBill?->bill_month ?? '-') . '/' . ($payment->monthlyBill?->bill_year ?? '-'),
            optional($payment->tanggal_bayar)->format('Y-m-d'),
            $payment->nominal_bayar,
            $payment->metode_pembayaran,
            $payment->reference_no,
            $payment->receiver?->name ?? '-',
        ];
    }
}