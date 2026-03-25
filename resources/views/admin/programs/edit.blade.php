@extends('admin.layouts.app')

@section('title', 'Edit Program')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Edit Program</h3>

    <form action="{{ route('admin.programs.update', $program) }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf
        @method('PUT')

        <label>
            Nama Program
            <input type="text" name="nama" value="{{ old('nama', $program->nama) }}" required>
        </label>

        <label>
            Level
            <input type="text" name="level" value="{{ old('level', $program->level) }}" required>
        </label>

        <label>
            Deskripsi
            <textarea name="deskripsi" rows="4">{{ old('deskripsi', $program->deskripsi) }}</textarea>
        </label>

        <label>
            Urutan
            <input type="number" name="urutan" value="{{ old('urutan', $program->urutan) }}">
        </label>

        <label style="display:flex; align-items:center; gap:8px;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $program->is_active) ? 'checked' : '' }} style="width:auto;">
            Aktif
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Update</button>
            <a href="{{ route('admin.programs.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection