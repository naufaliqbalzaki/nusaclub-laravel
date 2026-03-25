cat > resources/views/admin/locations/edit.blade.php <<'EOF'
@extends('admin.layouts.app')

@section('title', 'Edit Lokasi')

@section('content')
@if ($errors->any())
    <div class="admin-alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="table-card">
    <div class="admin-filterbar">
        <div>
            <h3 style="margin-bottom:6px;">Edit Lokasi Belajar</h3>
            <p style="margin:0; color:var(--admin-muted);">
                Perbarui nama lokasi, alamat detail, dan status aktif lokasi.
            </p>
        </div>
    </div>

    <form action="{{ route('admin.locations.update', $location) }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf
        @method('PUT')

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:24px;">
            <div>
                <label>Nama Lokasi
                    <input type="text"
                           name="nama"
                           value="{{ old('nama', $location->nama) }}"
                           placeholder="Contoh: Gresik Kota Baru"
                           required>
                </label>
            </div>

            <div>
                <label style="display:flex; align-items:center; gap:10px; font-weight:600; margin-top:34px;">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $location->is_active) ? 'checked' : '' }}
                           style="width:auto;">
                    Aktifkan lokasi ini
                </label>
            </div>
        </div>

        <label>Alamat Detail
            <textarea name="alamat_detail"
                      rows="5"
                      placeholder="Tulis alamat lengkap atau detail lokasi (opsional)">{{ old('alamat_detail', $location->alamat_detail) }}</textarea>
        </label>

        <div class="form-actions" style="margin-top:20px;">
            <button type="submit" class="btn btn-filled" style="padding:12px 18px; border:none;">
                <i class="fas fa-floppy-disk"></i>
                Update
            </button>

            <a href="{{ route('admin.locations.index') }}" class="btn btn-outline" style="padding:12px 18px;">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
EOF