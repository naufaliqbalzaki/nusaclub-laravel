@extends('admin.layouts.app')

@section('title', 'Paket')

@section('content')
<div class="table-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h3>Daftar Paket</h3>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-filled">+ Tambah Paket</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Program</th>
                <th>Tipe Tagihan</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($packages as $package)
                <tr>
                    <td>{{ $package->nama }}</td>
                    <td>{{ $package->program?->nama ?? '-' }}</td>
                    <td>{{ $package->tipe_tagihan }}</td>
                    <td>Rp{{ number_format($package->harga, 0, ',', '.') }}</td>
                    <td>{{ $package->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                    <td style="display:flex; gap:8px;">
                        <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-outline" style="padding:8px 12px;">Edit</a>
                        <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" onsubmit="return confirm('Hapus paket ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-filled" style="padding:8px 12px; border:none;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada paket.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:16px;">
        {{ $packages->links() }}
    </div>
</div>
@endsection