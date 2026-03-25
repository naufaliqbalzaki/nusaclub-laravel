cat > resources/views/admin/locations/index.blade.php <<'EOF'
@extends('admin.layouts.app')

@section('title', 'Lokasi Belajar')

@section('content')
<div class="table-card">
    <div class="admin-filterbar">
        <div>
            <h3 style="margin-bottom:6px;">Daftar Lokasi Belajar</h3>
            <p style="margin:0; color:var(--admin-muted);">
                Kelola lokasi belajar yang akan muncul pada form pendaftaran publik.
            </p>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('admin.locations.create') }}" class="btn btn-filled" style="padding:12px 16px;">
                <i class="fas fa-plus"></i>
                Tambah Lokasi
            </a>
        </div>
    </div>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Nama Lokasi</th>
                <th>Alamat Detail</th>
                <th>Status</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($locations as $location)
                <tr>
                    <td>
                        <strong>{{ $location->nama }}</strong><br>
                        <span style="color:var(--admin-muted); font-size:12px;">
                            ID Lokasi: #{{ $location->id }}
                        </span>
                    </td>

                    <td style="max-width:360px;">
                        <div style="line-height:1.7; color:#334155;">
                            {{ $location->alamat_detail ? \Illuminate\Support\Str::limit($location->alamat_detail, 100) : '-' }}
                        </div>
                    </td>

                    <td>
                        @if ($location->is_active)
                            <span class="badge" style="background:#dcfce7; color:#166534;">Aktif</span>
                        @else
                            <span class="badge" style="background:#fee2e2; color:#991b1b;">Nonaktif</span>
                        @endif
                    </td>

                    <td>
                        {{ $location->created_at ? $location->created_at->format('d-m-Y H:i') : '-' }}
                    </td>

                    <td>
                        <div style="display:flex; gap:8px; flex-wrap:wrap;">
                            <a href="{{ route('admin.locations.edit', $location) }}"
                               class="btn btn-outline"
                               style="padding:10px 14px;">
                                <i class="fas fa-pen"></i>
                                Edit
                            </a>

                            <form action="{{ route('admin.locations.destroy', $location) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus lokasi ini?')"
                                  style="margin:0;">
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
                    <td colspan="5" class="admin-empty">Belum ada lokasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:18px;">
        {{ $locations->links('vendor.pagination.admin') }}
    </div>
</div>
@endsection
EOF