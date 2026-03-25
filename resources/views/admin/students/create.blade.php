@extends('admin.layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Tambah Siswa</h3>

    <form action="{{ route('admin.students.store') }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf

        <label>
            Nama
            <input type="text" name="nama" value="{{ old('nama') }}" required>
        </label>

        <label>
            WhatsApp
            <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" required>
        </label>

        <label>
            Usia
            <input type="number" name="usia" min="4" value="{{ old('usia') }}" required>
        </label>

        <label>
            Alamat
            <textarea name="alamat" rows="3">{{ old('alamat') }}</textarea>
        </label>

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
            Paket
            <select name="package_id">
                <option value="">-- Pilih Paket --</option>
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                        {{ $package->nama }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>
            Tanggal Mulai
            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
        </label>

        <label>
            Status
            <select name="status" required>
                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>aktif</option>
                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>nonaktif</option>
                <option value="cuti" {{ old('status') == 'cuti' ? 'selected' : '' }}>cuti</option>
            </select>
        </label>

        <label>
            Catatan
            <textarea name="catatan" rows="3">{{ old('catatan') }}</textarea>
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Simpan</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection