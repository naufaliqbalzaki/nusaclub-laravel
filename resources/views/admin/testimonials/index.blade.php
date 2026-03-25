@extends('admin.layouts.app')

@section('title', 'Testimoni')

@section('content')
<div class="table-card">
    <div class="admin-filterbar">
        <div>
            <h3 style="margin-bottom:6px;">Daftar Testimoni</h3>
            <p style="margin:0; color:var(--admin-muted);">
                Kelola testimoni dari pengunjung website dan tentukan mana yang tampil di halaman publik.
            </p>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-filled" style="padding:12px 16px;">
                <i class="fas fa-plus"></i>
                Tambah Testimoni
            </a>
        </div>
    </div>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Isi</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Moderasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($testimonials as $item)
                <tr>
                    <td>
                        <strong>{{ $item->nama }}</strong><br>
                        <span style="color:var(--admin-muted); font-size:12px;">
                            ID Testimoni: #{{ $item->id }}
                        </span>
                    </td>

                    <td style="max-width:320px;">
                        <div style="line-height:1.7; color:#334155;">
                            {{ \Illuminate\Support\Str::limit($item->isi, 110) }}
                        </div>
                    </td>

                    <td>
                        <span class="badge" style="background:#fff7ed; color:#9a3412;">
                            {{ $item->rating }}/5
                        </span>
                    </td>

                    <td>
                        @php
                            $statusStyle = match($item->status) {
                                'approved' => 'background:#dcfce7; color:#166534;',
                                'pending' => 'background:#fef3c7; color:#92400e;',
                                'hidden' => 'background:#e2e8f0; color:#334155;',
                                'rejected' => 'background:#fee2e2; color:#991b1b;',
                                default => 'background:#eef2ff; color:#3730a3;',
                            };
                        @endphp

                        <span class="badge" style="{{ $statusStyle }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>

                    <td>
                        @if ($item->is_featured)
                            <span class="badge" style="background:#dbeafe; color:#1d4ed8;">Ya</span>
                        @else
                            <span class="badge" style="background:#f8fafc; color:#64748b;">Tidak</span>
                        @endif
                    </td>

                    <td>
                        <form action="{{ route('admin.testimonials.update-status', $item) }}" method="POST" style="display:flex; gap:8px; flex-wrap:wrap;">
                            @csrf
                            @method('PATCH')

                            <select name="status" style="min-width:150px;">
                                <option value="pending" @selected($item->status === 'pending')>Pending</option>
                                <option value="approved" @selected($item->status === 'approved')>Approved</option>
                                <option value="hidden" @selected($item->status === 'hidden')>Hidden</option>
                                <option value="rejected" @selected($item->status === 'rejected')>Rejected</option>
                            </select>

                            <button type="submit" class="btn btn-filled" style="padding:10px 14px; border:none;">
                                <i class="fas fa-floppy-disk"></i>
                                Simpan
                            </button>
                        </form>
                    </td>

                    <td>
                        <div style="display:flex; gap:8px; flex-wrap:wrap;">
                            <a href="{{ route('admin.testimonials.edit', $item) }}" class="btn btn-outline" style="padding:10px 14px;">
                                <i class="fas fa-pen"></i>
                                Edit
                            </a>

                            <form action="{{ route('admin.testimonials.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')" style="margin:0;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-filled"
                                        style="padding:10px 14px; border:none; background:linear-gradient(135deg,#ef4444,#dc2626); box-shadow:0 12px 24px rgba(220,38,38,0.18);">
                                    <i class="fas fa-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="admin-empty">Belum ada testimoni.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:18px;">
        {{ $testimonials->links('vendor.pagination.admin') }}
    </div>
</div>
@endsection