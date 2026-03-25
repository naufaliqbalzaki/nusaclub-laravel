@extends('admin.layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Edit Siswa</h3>

    <form action="{{ route('admin.students.update', $student) }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf
        @method('PUT')

        <label>
            Nama
            <input type="text" name="nama" value="{{ old('nama', $student->nama) }}" required>
        </label>

        <label>
            WhatsApp
            <input type="text" name="whatsapp" value="{{ old('whatsapp', $student->whatsapp) }}" required>
        </label>

        <label>
            Usia
            <input type="number" name="usia" min="4" value="{{ old('usia', $student->usia) }}" required>
        </label>

        <label>
            Alamat
            <textarea name="alamat" rows="3">{{ old('alamat', $student->alamat) }}</textarea>
        </label>

        <label>
            Program
            <select name="program_id">
                <option value="">-- Pilih Program --</option>
                @foreach ($programs as $program)
                    <option value="{{ $program->id }}" {{ old('program_id', $student->program_id) == $program->id ? 'selected' : '' }}>
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
                    <option value="{{ $package->id }}" {{ old('package_id', $student->package_id) == $package->id ? 'selected' : '' }}>
                        {{ $package->nama }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>
            Tanggal Mulai
            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($student->tanggal_mulai)->format('Y-m-d')) }}" required>
        </label>

        <label>
            Status
            <select name="status" required>
                <option value="aktif" {{ old('status', $student->status) == 'aktif' ? 'selected' : '' }}>aktif</option>
                <option value="nonaktif" {{ old('status', $student->status) == 'nonaktif' ? 'selected' : '' }}>nonaktif</option>
                <option value="cuti" {{ old('status', $student->status) == 'cuti' ? 'selected' : '' }}>cuti</option>
            </select>
        </label>

        <label>
            Catatan
            <textarea name="catatan" rows="3">{{ old('catatan', $student->catatan) }}</textarea>
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Update</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection