<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendaftaransExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection(): Collection
    {
        return Pendaftaran::with('program')
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'WhatsApp',
            'Usia',
            'Program',
            'Lokasi',
            'Status',
            'Tanggal Daftar',
        ];
    }

    public function map($pendaftaran): array
    {
        return [
            $pendaftaran->id,
            $pendaftaran->nama,
            $pendaftaran->whatsapp,
            $pendaftaran->usia,
            $pendaftaran->program?->nama ?? '-',
            $pendaftaran->lokasi,
            $pendaftaran->status,
            optional($pendaftaran->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}