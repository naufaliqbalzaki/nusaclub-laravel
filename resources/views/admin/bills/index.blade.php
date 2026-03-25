@extends('admin.layouts.app')

@section('title', 'Tagihan Bulanan')

@section('content')
<div class="table-card" style="margin-bottom:20px;">
    <h3 style="margin-bottom:16px;">Generate Tagihan Otomatis</h3>

    <form action="{{ route('admin.bills.generate') }}" method="POST" style="display:flex; gap:12px; flex-wrap:wrap; align-items:end;">
        @csrf

        <div>
            <label>Bulan</label>
            <input type="number" name="bill_month" min="1" max="12" value="{{ now()->month }}" style="padding:12px 14px; border:1px solid #d1d5db; border-radius:12px;">
        </div>

        <div>
            <label>Tahun</label>
            <input type="number" name="bill_year" value="{{ now()->year }}" style="padding:12px 14px; border:1px solid #d1d5db; border-radius:12px;">
        </div>

        <div>
            <label>Jatuh Tempo</label>
            <input type="date" name="jatuh_tempo" value="{{ now()->addDays(7)->format('Y-m-d') }}" style="padding:12px 14px; border:1px solid #d1d5db; border-radius:12px;">
        </div>

        <button type="submit" class="btn btn-filled" style="border:none;">Generate</button>
    </form>
</div>

<div class="table-card" style="margin-bottom:20px;">
    <form method="GET" action="{{ route('admin.bills.index') }}" style="display:flex; gap:12px; flex-wrap:wrap;">
        <input type="number" name="bill_month" min="1" max="12" value="{{ request('bill_month') }}" placeholder="Bulan"
               style="padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; width:120px;">

        <input type="number" name="bill_year" value="{{ request('bill_year') }}" placeholder="Tahun"
               style="padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; width:140px;">

        <select name="status" style="padding:12px 14px; border:1px solid #d1d5db; border-radius:12px;">
            <option value="">Semua Status</option>
            <option value="belum_bayar" @selected(request('status') === 'belum_bayar')>belum_bayar</option>
            <option value="cicilan" @selected(request('status') === 'cicilan')>cicilan</option>
            <option value="lunas" @selected(request('status') === 'lunas')>lunas</option>
            <option value="lewat_jatuh_tempo" @selected(request('status') === 'lewat_jatuh_tempo')>lewat_jatuh_tempo</option>
            <option value="batal" @selected(request('status') === 'batal')>batal</option>
        </select>

        <button type="submit" class="btn btn-filled" style="border:none;">Filter</button>
        <a href="{{ route('admin.bills.create') }}" class="btn btn-outline">+ Tambah Tagihan</a>
    </form>
</div>

<div class="table-card">
    <h3 style="margin-bottom:16px;">Daftar Tagihan</h3>

    <table>
        <thead>
            <tr>
                <th>Siswa</th>
                <th>Bulan/Tahun</th>
                <th>Nominal</th>
                <th>Diskon</th>
                <th>Total</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bills as $bill)
                <tr>
                    <td>{{ $bill->student?->nama ?? '-' }}</td>
                    <td>{{ $bill->bill_month }}/{{ $bill->bill_year }}</td>
                    <td>Rp{{ number_format($bill->nominal, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($bill->diskon, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($bill->total, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($bill->jatuh_tempo)->format('d-m-Y') }}</td>
                    <td>{{ $bill->status }}</td>
                    <td style="display:flex; gap:8px;">
                        <a href="{{ route('admin.bills.edit', $bill) }}" class="btn btn-outline" style="padding:8px 12px;">Edit</a>
                        <form action="{{ route('admin.bills.destroy', $bill) }}" method="POST" onsubmit="return confirm('Hapus tagihan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-filled" style="padding:8px 12px; border:none;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada tagihan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:16px;">
        {{ $bills->links() }}
    </div>
</div>
@endsection