@extends('admin.layouts.app')

@section('title', 'Pelatih')

@section('content')
<div class="table-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h3>Daftar Pelatih</h3>
        <a href="{{ route('admin.coaches.create') }}" class="btn btn-filled">+ Tambah Pelatih</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($coaches as $coach)
                <tr>
                    <td>
                        @if ($coach->photo_url)
                            <img src="{{ $coach->photo_url }}" alt="{{ $coach->nama }}" style="width:60px; height:60px; object-fit:cover; border-radius:8px;">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $coach->nama }}</td>
                    <td>{{ $coach->jabatan }}</td>
                    <td>{{ $coach->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                    <td style="display:flex; gap:8px;">
                        <a href="{{ route('admin.coaches.edit', $coach) }}" class="btn btn-outline" style="padding:8px 12px;">Edit</a>
                        <form action="{{ route('admin.coaches.destroy', $coach) }}" method="POST" onsubmit="return confirm('Hapus pelatih ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-filled" style="padding:8px 12px; border:none;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada pelatih.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:16px;">{{ $coaches->links() }}</div>
</div>
@endsection