@extends('admin.layouts.app')

@section('title', 'Program')

@section('content')
<div class="table-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h3>Daftar Program</h3>
        <a href="{{ route('admin.programs.create') }}" class="btn btn-filled">+ Tambah Program</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Slug</th>
                <th>Level</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($programs as $program)
                <tr>
                    <td>{{ $program->nama }}</td>
                    <td>{{ $program->slug }}</td>
                    <td>{{ $program->level }}</td>
                    <td>{{ $program->urutan }}</td>
                    <td>{{ $program->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                    <td style="display:flex; gap:8px;">
                        <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-outline" style="padding:8px 12px;">Edit</a>
                        <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" onsubmit="return confirm('Hapus program ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-filled" style="padding:8px 12px; border:none;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada program.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:16px;">
        {{ $programs->links() }}
    </div>
</div>
@endsection