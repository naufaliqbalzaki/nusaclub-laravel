@extends('admin.layouts.app')

@section('title', 'Edit Paket')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Edit Paket</h3>

    <form action="{{ route('admin.packages.update', $package) }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf
        @method('PUT')

        <label>
            Program
            <select name="program_id">
                <option value="">-- Pilih Program --</option>
                @foreach ($programs as $program)
                    <option value="{{ $program->id }}" {{ old('program_id', $package->program_id) == $program->id ? 'selected' : '' }}>
                        {{ $program->nama }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>
            Nama Paket
            <input type="text" name="nama" value="{{ old('nama', $package->nama) }}" required>
        </label>

        <label>
            Tipe Tagihan
            <select name="tipe_tagihan" required>
                <option value="monthly" {{ old('tipe_tagihan', $package->tipe_tagihan) == 'monthly' ? 'selected' : '' }}>monthly</option>
                <option value="one_time" {{ old('tipe_tagihan', $package->tipe_tagihan) == 'one_time' ? 'selected' : '' }}>one_time</option>
                <option value="per_session" {{ old('tipe_tagihan', $package->tipe_tagihan) == 'per_session' ? 'selected' : '' }}>per_session</option>
            </select>
        </label>

        <label>
            Harga
            <input type="number" step="0.01" name="harga" value="{{ old('harga', $package->harga) }}" required>
        </label>

        <label>
            Durasi
            <input type="text" name="durasi" value="{{ old('durasi', $package->durasi) }}">
        </label>

        <label>
            Jadwal
            <textarea name="jadwal" rows="3">{{ old('jadwal', $package->jadwal) }}</textarea>
        </label>

        <label>
            Deskripsi
            <textarea name="deskripsi" rows="4">{{ old('deskripsi', $package->deskripsi) }}</textarea>
        </label>

        <label style="display:flex; align-items:center; gap:8px;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }} style="width:auto;">
            Aktif
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Update</button>
            <a href="{{ route('admin.packages.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection