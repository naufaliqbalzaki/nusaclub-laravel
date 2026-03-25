@extends('admin.layouts.app')

@section('title', 'Tambah Tagihan')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Tambah Tagihan</h3>

    <form action="{{ route('admin.bills.store') }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf

        <label>
            Siswa
            <select name="student_id" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                        {{ $student->nama }} - {{ $student->package?->nama ?? 'Tanpa Paket' }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>
            Bulan
            <input type="number" name="bill_month" min="1" max="12" value="{{ old('bill_month', now()->month) }}" required>
        </label>

        <label>
            Tahun
            <input type="number" name="bill_year" value="{{ old('bill_year', now()->year) }}" required>
        </label>

        <label>
            Nominal
            <input type="number" step="0.01" name="nominal" value="{{ old('nominal') }}" required>
        </label>

        <label>
            Diskon
            <input type="number" step="0.01" name="diskon" value="{{ old('diskon', 0) }}">
        </label>

        <label>
            Jatuh Tempo
            <input type="date" name="jatuh_tempo" value="{{ old('jatuh_tempo', now()->addDays(7)->format('Y-m-d')) }}" required>
        </label>

        <label>
            Catatan
            <textarea name="catatan" rows="3">{{ old('catatan') }}</textarea>
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Simpan</button>
            <a href="{{ route('admin.bills.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection