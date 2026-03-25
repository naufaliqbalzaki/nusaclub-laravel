@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <h4>Total Pendaftar</h4>
        <h2>{{ number_format($totalPendaftar) }}</h2>
    </div>

    <div class="stat-card">
        <h4>Pendaftar Hari Ini</h4>
        <h2>{{ number_format($pendaftarHariIni) }}</h2>
    </div>

    <div class="stat-card">
        <h4>Siswa Aktif</h4>
        <h2>{{ number_format($totalSiswaAktif) }}</h2>
    </div>

    <div class="stat-card">
        <h4>Tagihan Belum Lunas</h4>
        <h2>{{ number_format($tagihanBelumLunas) }}</h2>
    </div>

    <div class="stat-card">
        <h4>Pembayaran Bulan Ini</h4>
        <h2>Rp{{ number_format($pembayaranBulanIni, 0, ',', '.') }}</h2>
    </div>

    <div class="stat-card">
        <h4>Total Tunggakan</h4>
        <h2>Rp{{ number_format($totalTunggakan, 0, ',', '.') }}</h2>
    </div>
</div>

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:24px; margin-bottom:24px;">
    <div class="table-card" style="margin-bottom:0;">
        <h3 style="margin-bottom:16px;">Ringkasan Status Pendaftaran</h3>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            @forelse ($pendaftaranPerStatus as $status => $total)
                <div class="badge badge-{{ $status }}" style="padding:10px 14px;">
                    {{ ucfirst($status) }}: {{ $total }}
                </div>
            @empty
                <div class="admin-empty" style="padding:0;">Belum ada data status pendaftaran.</div>
            @endforelse
        </div>
    </div>

    <div class="table-card" style="margin-bottom:0;">
        <h3 style="margin-bottom:16px;">Ringkasan Status Tagihan</h3>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            @forelse ($tagihanPerStatus as $status => $total)
                <span class="badge" style="padding:10px 14px; background:#eef6ff; color:#0f172a;">
                    {{ str_replace('_', ' ', ucfirst($status)) }}: {{ $total }}
                </span>
            @empty
                <div class="admin-empty" style="padding:0;">Belum ada data tagihan.</div>
            @endforelse
        </div>
    </div>
</div>

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(420px, 1fr)); gap:24px;">
    <div class="table-card" style="margin-bottom:0;">
        <div class="admin-filterbar" style="margin-bottom:12px;">
            <div>
                <h3 style="margin-bottom:6px;">Pendaftaran Terbaru</h3>
                <p style="margin:0; color:var(--admin-muted);">Monitor calon siswa terbaru yang masuk.</p>
            </div>
            <a href="{{ route('admin.pendaftarans.index') }}" class="btn btn-outline" style="padding:10px 14px;">Lihat Semua</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Usia</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendaftaranTerbaru as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->nama }}</strong><br>
                            <span style="color:var(--admin-muted); font-size:12px;">{{ $item->whatsapp }}</span>
                        </td>
                        <td>{{ $item->usia }}</td>
                        <td>
                            <span class="badge badge-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                        </td>
                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="admin-empty">Belum ada data pendaftaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="table-card" style="margin-bottom:0;">
        <div class="admin-filterbar" style="margin-bottom:12px;">
            <div>
                <h3 style="margin-bottom:6px;">Pembayaran Terbaru</h3>
                <p style="margin:0; color:var(--admin-muted);">Pantau transaksi pembayaran terakhir.</p>
            </div>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-outline" style="padding:10px 14px;">Lihat Semua</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Metode</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayaranTerbaru as $payment)
                    <tr>
                        <td>{{ $payment->student?->nama ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d-m-Y') }}</td>
                        <td><strong>Rp{{ number_format($payment->nominal_bayar, 0, ',', '.') }}</strong></td>
                        <td>
                            <span class="badge" style="background:#eef6ff; color:#0f172a;">
                                {{ strtoupper($payment->metode_pembayaran) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="admin-empty">Belum ada data pembayaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection