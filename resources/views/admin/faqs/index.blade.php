@extends('admin.layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="table-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h3>Daftar FAQ</h3>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-filled">+ Tambah FAQ</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Pertanyaan</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($faqs as $faq)
                <tr>
                    <td>{{ $faq->pertanyaan }}</td>
                    <td>{{ $faq->urutan }}</td>
                    <td>{{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                    <td style="display:flex; gap:8px;">
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-outline" style="padding:8px 12px;">Edit</a>
                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-filled" style="padding:8px 12px; border:none;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada FAQ.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:16px;">{{ $faqs->links() }}</div>
</div>
@endsection