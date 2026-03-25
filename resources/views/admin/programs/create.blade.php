@extends('admin.layouts.app')

@section('title', 'Tambah Program')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Tambah Program</h3>

    <form action="{{ route('admin.programs.store') }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf

        <label>
            Nama Program
            <input type="text" name="nama" value="{{ old('nama') }}" required>
        </label>

        <label>
            Level
            <input type="text" name="level" value="{{ old('level') }}" placeholder="beginner / intermediate / advanced" required>
        </label>

        <label>
            Deskripsi
            <textarea name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
        </label>

        <label>
            Urutan
            <input type="number" name="urutan" value="{{ old('urutan', 0) }}">
        </label>

        <label style="display:flex; align-items:center; gap:8px;">
            <input type="checkbox" name="is_active" value="1" checked style="width:auto;">
            Aktif
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Simpan</button>
            <a href="{{ route('admin.programs.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection