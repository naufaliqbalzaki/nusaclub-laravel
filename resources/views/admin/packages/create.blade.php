@extends('admin.layouts.app')

@section('title', 'Tambah Paket')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Tambah Paket</h3>

    <form action="{{ route('admin.packages.store') }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf

        <label>
            Program
            <select name="program_id">
                <option value="">-- Pilih Program --</option>
                @foreach ($programs as $program)
                    <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                        {{ $program->nama }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>
            Nama Paket
            <input type="text" name="nama" value="{{ old('nama') }}" required>
        </label>

        <label>
            Tipe Tagihan
            <select name="tipe_tagihan" required>
                <option value="monthly" {{ old('tipe_tagihan') == 'monthly' ? 'selected' : '' }}>monthly</option>
                <option value="one_time" {{ old('tipe_tagihan') == 'one_time' ? 'selected' : '' }}>one_time</option>
                <option value="per_session" {{ old('tipe_tagihan') == 'per_session' ? 'selected' : '' }}>per_session</option>
            </select>
        </label>

        <label>
            Harga
            <input type="number" step="0.01" name="harga" value="{{ old('harga') }}" required>
        </label>

        <label>
            Durasi
            <input type="text" name="durasi" value="{{ old('durasi') }}" placeholder="Contoh: 4x per bulan">
        </label>

        <label>
            Jadwal
            <textarea name="jadwal" rows="3">{{ old('jadwal') }}</textarea>
        </label>

        <label>
            Deskripsi
            <textarea name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
        </label>

        <label style="display:flex; align-items:center; gap:8px;">
            <input type="checkbox" name="is_active" value="1" checked style="width:auto;">
            Aktif
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Simpan</button>
            <a href="{{ route('admin.packages.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection