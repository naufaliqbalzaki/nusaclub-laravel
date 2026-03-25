@extends('admin.layouts.app')

@section('title', 'Tambah Pelatih')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Tambah Pelatih</h3>

    <form action="{{ route('admin.coaches.store') }}" method="POST" enctype="multipart/form-data" class="daftar-form" style="max-width:100%;">
        @csrf

        <label>Nama
            <input type="text" name="nama" value="{{ old('nama') }}" required>
        </label>

        <label>Jabatan
            <input type="text" name="jabatan" value="{{ old('jabatan') }}" required>
        </label>

        <label>Deskripsi
            <textarea name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
        </label>

        <label>Foto
            <input type="file" name="foto" accept="image/*">
        </label>

        <label>Instagram URL
            <input type="url" name="instagram" value="{{ old('instagram') }}">
        </label>

        <label>Twitter URL
            <input type="url" name="twitter" value="{{ old('twitter') }}">
        </label>

        <label>LinkedIn URL
            <input type="url" name="linkedin" value="{{ old('linkedin') }}">
        </label>

        <label style="display:flex; align-items:center; gap:8px;">
            <input type="checkbox" name="is_active" value="1" checked style="width:auto;">
            Aktif
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Simpan</button>
            <a href="{{ route('admin.coaches.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection