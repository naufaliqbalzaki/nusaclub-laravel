@extends('admin.layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="table-card">
    <div class="admin-filterbar">
        <div>
            <h3 style="margin-bottom:6px;">Manajemen Pembayaran</h3>
            <p style="margin:0; color:var(--admin-muted);">Catat transaksi, cek bukti bayar, dan export data ke Excel.</p>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('admin.payments.export') }}" class="btn btn-outline" style="padding:12px 16px;">
                <i class="fas fa-file-excel"></i>
                Export XLSX
            </a>
            <a href="{{ route('admin.payments.create') }}" class="btn btn-filled" style="padding:12px 16px;">
                <i class="fas fa-plus"></i>
                Input Pembayaran
            </a>
        </div>
    </div>
</div>

<div class="table-card">
    <h3 style="margin-bottom:18px;">Daftar Pembayaran</h3>

    <table>
        <thead>
            <tr>
                <th>Siswa</th>
                <th>Periode Tagihan</th>
                <th>Tanggal Bayar</th>
                <th>Nominal</th>
                <th>Metode</th>
                <th>Bukti</th>
                <th>Diterima Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>
                        <strong>{{ $payment->student?->nama ?? '-' }}</strong><br>
                        <span style="color:var(--admin-muted); font-size:12px;">ID Bayar: #{{ $payment->id }}</span>
                    </td>
                    <td>
                        <span class="badge" style="background:#eef6ff; color:#0f172a;">
                            {{ $payment->monthlyBill?->bill_month ?? '-' }}/{{ $payment->monthlyBill?->bill_year ?? '-' }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d-m-Y') }}</td>
                    <td>
                        <strong>Rp{{ number_format($payment->nominal_bayar, 0, ',', '.') }}</strong>
                    </td>
                    <td>
                        <span class="badge" style="background:#f8fafc; color:#0f172a;">
                            {{ strtoupper($payment->metode_pembayaran) }}
                        </span>
                    </td>
                    <td>
                        @if ($payment->bukti_bayar)
                            <a href="{{ $payment->bukti_bayar_url ?? asset('storage/' . $payment->bukti_bayar) }}" target="_blank" class="btn btn-outline" style="padding:8px 12px;">
                                <i class="fas fa-paperclip"></i>
                                Lihat
                            </a>
                        @else
                            <span style="color:var(--admin-muted);">-</span>
                        @endif
                    </td>
                    <td>{{ $payment->receiver?->name ?? '-' }}</td>
                    <td>
                        <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" onsubmit="return confirm('Hapus pembayaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-filled" style="padding:10px 14px; border:none; background:linear-gradient(135deg,#ef4444,#dc2626); box-shadow:0 12px 24px rgba(220,38,38,0.18);">
                                <i class="fas fa-trash"></i>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="admin-empty">Belum ada pembayaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:18px;">
        {{ $payments->links() }}
    </div>
</div>
@endsection