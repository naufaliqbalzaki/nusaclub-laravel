@extends('admin.layouts.app')

@section('title', 'Edit Pelatih')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Edit Pelatih</h3>

    <form action="{{ route('admin.coaches.update', $coach) }}" method="POST" enctype="multipart/form-data" class="daftar-form" style="max-width:100%;">
        @csrf
        @method('PUT')

        <label>Nama
            <input type="text" name="nama" value="{{ old('nama', $coach->nama) }}" required>
        </label>

        <label>Jabatan
            <input type="text" name="jabatan" value="{{ old('jabatan', $coach->jabatan) }}" required>
        </label>

        <label>Deskripsi
            <textarea name="deskripsi" rows="4">{{ old('deskripsi', $coach->deskripsi) }}</textarea>
        </label>

        @if ($coach->photo_url)
            <div style="margin-bottom:12px;">
                <img src="{{ $coach->photo_url }}" alt="{{ $coach->nama }}" style="width:120px; height:120px; object-fit:cover; border-radius:12px;">
            </div>
        @endif

        <label>Foto
            <input type="file" name="foto" accept="image/*">
        </label>

        <label>Instagram URL
            <input type="url" name="instagram" value="{{ old('instagram', $coach->instagram) }}">
        </label>

        <label>Twitter URL
            <input type="url" name="twitter" value="{{ old('twitter', $coach->twitter) }}">
        </label>

        <label>LinkedIn URL
            <input type="url" name="linkedin" value="{{ old('linkedin', $coach->linkedin) }}">
        </label>

        <label style="display:flex; align-items:center; gap:8px;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $coach->is_active) ? 'checked' : '' }} style="width:auto;">
            Aktif
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Update</button>
            <a href="{{ route('admin.coaches.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection