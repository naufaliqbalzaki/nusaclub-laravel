@extends('admin.layouts.app')

@section('title', 'Data Pendaftaran')

@section('content')
<div class="table-card">
    <div class="admin-filterbar">
        <div>
            <h3 style="margin-bottom:6px;">Filter Pendaftaran</h3>
            <p style="margin:0; color:var(--admin-muted);">Cari dan kelola data calon siswa dengan cepat.</p>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('admin.pendaftarans.export') }}" class="btn btn-outline" style="padding:12px 16px;">
                <i class="fas fa-file-excel"></i>
                Export XLSX
            </a>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.pendaftarans.index') }}" class="admin-filterbar" style="justify-content:flex-start; margin-top:16px; margin-bottom:0;">
        <input
            type="text"
            name="keyword"
            value="{{ request('keyword') }}"
            placeholder="Cari nama / whatsapp / lokasi"
            style="max-width:320px;"
        >

        <select name="status" style="max-width:220px;">
            <option value="">Semua Status</option>
            <option value="baru" @selected(request('status') === 'baru')>Baru</option>
            <option value="dihubungi" @selected(request('status') === 'dihubungi')>Dihubungi</option>
            <option value="trial" @selected(request('status') === 'trial')>Trial</option>
            <option value="diterima" @selected(request('status') === 'diterima')>Diterima</option>
            <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
            <option value="batal" @selected(request('status') === 'batal')>Batal</option>
        </select>

        <button type="submit" class="btn btn-filled" style="padding:12px 18px; border:none;">
            <i class="fas fa-filter"></i>
            Filter
        </button>

        <a href="{{ route('admin.pendaftarans.index') }}" class="btn btn-outline" style="padding:12px 18px;">
            Reset
        </a>
    </form>
</div>

<div class="table-card">
    <div class="admin-filterbar">
        <div>
            <h3 style="margin-bottom:6px;">Daftar Pendaftaran</h3>
            <p style="margin:0; color:var(--admin-muted);">Kelola status dan konversi pendaftar menjadi siswa aktif.</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Program</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Tanggal Masuk</th>
                <th>Ubah Status</th>
                <th>Konversi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendaftarans as $item)
                <tr>
                    <td>
                        <strong>{{ $item->nama }}</strong><br>
                        <span style="color:var(--admin-muted); font-size:12px;">{{ $item->whatsapp }}</span><br>
                        <span style="color:var(--admin-muted); font-size:12px;">Usia: {{ $item->usia }} tahun</span>
                    </td>
                    <td>{{ $item->program?->nama ?? '-' }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>
                        <span class="badge badge-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                    </td>
                    <td>{{ $item->created_at?->format('d-m-Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.pendaftarans.update-status', $item) }}" method="POST" style="display:flex; gap:8px; flex-wrap:wrap;">
                            @csrf
                            @method('PATCH')

                            <select name="status" style="min-width:150px;">
                                <option value="baru" @selected($item->status === 'baru')>Baru</option>
                                <option value="dihubungi" @selected($item->status === 'dihubungi')>Dihubungi</option>
                                <option value="trial" @selected($item->status === 'trial')>Trial</option>
                                <option value="diterima" @selected($item->status === 'diterima')>Diterima</option>
                                <option value="aktif" @selected($item->status === 'aktif')>Aktif</option>
                                <option value="batal" @selected($item->status === 'batal')>Batal</option>
                            </select>

                            <button type="submit" class="btn btn-filled" style="padding:10px 14px; border:none;">
                                Simpan
                            </button>
                        </form>
                    </td>
                    <td>
                        @if ($item->student)
                            <a href="{{ route('admin.students.edit', $item->student) }}" class="btn btn-outline" style="padding:10px 14px;">
                                <i class="fas fa-eye"></i>
                                Lihat Siswa
                            </a>
                        @else
                            <form action="{{ route('admin.pendaftarans.convert', $item) }}" method="POST" onsubmit="return confirm('Konversi pendaftaran ini menjadi siswa aktif?')">
                                @csrf
                                <button type="submit" class="btn btn-filled" style="padding:10px 14px; border:none;">
                                    <i class="fas fa-user-check"></i>
                                    Jadikan Siswa
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="admin-empty">Belum ada data pendaftaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:18px;">
        {{ $pendaftarans->links() }}
    </div>
</div>
@endsection