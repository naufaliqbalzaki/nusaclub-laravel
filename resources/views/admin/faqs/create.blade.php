@extends('admin.layouts.app')

@section('title', 'Tambah FAQ')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Tambah FAQ</h3>

    <form action="{{ route('admin.faqs.store') }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf

        <label>Pertanyaan
            <input type="text" name="pertanyaan" value="{{ old('pertanyaan') }}" required>
        </label>

        <label>Jawaban
            <textarea name="jawaban" rows="4" required>{{ old('jawaban') }}</textarea>
        </label>

        <label>Urutan
            <input type="number" name="urutan" value="{{ old('urutan', 0) }}">
        </label>

        <label style="display:flex; align-items:center; gap:8px;">
            <input type="checkbox" name="is_active" value="1" checked style="width:auto;">
            Aktif
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Simpan</button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection