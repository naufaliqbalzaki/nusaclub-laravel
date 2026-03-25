@extends('admin.layouts.app')

@section('title', 'Edit Tagihan')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Edit Tagihan</h3>

    <form action="{{ route('admin.bills.update', $monthlyBill) }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf
        @method('PUT')

        <label>
            Siswa
            <select name="student_id" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id', $monthlyBill->student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->nama }} - {{ $student->package?->nama ?? 'Tanpa Paket' }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>
            Bulan
            <input type="number" name="bill_month" min="1" max="12" value="{{ old('bill_month', $monthlyBill->bill_month) }}" required>
        </label>

        <label>
            Tahun
            <input type="number" name="bill_year" value="{{ old('bill_year', $monthlyBill->bill_year) }}" required>
        </label>

        <label>
            Nominal
            <input type="number" step="0.01" name="nominal" value="{{ old('nominal', $monthlyBill->nominal) }}" required>
        </label>

        <label>
            Diskon
            <input type="number" step="0.01" name="diskon" value="{{ old('diskon', $monthlyBill->diskon) }}">
        </label>

        <label>
            Jatuh Tempo
            <input type="date" name="jatuh_tempo" value="{{ old('jatuh_tempo', \Carbon\Carbon::parse($monthlyBill->jatuh_tempo)->format('Y-m-d')) }}" required>
        </label>

        <label>
            Status
            <select name="status" required>
                <option value="belum_bayar" @selected(old('status', $monthlyBill->status) === 'belum_bayar')>belum_bayar</option>
                <option value="cicilan" @selected(old('status', $monthlyBill->status) === 'cicilan')>cicilan</option>
                <option value="lunas" @selected(old('status', $monthlyBill->status) === 'lunas')>lunas</option>
                <option value="lewat_jatuh_tempo" @selected(old('status', $monthlyBill->status) === 'lewat_jatuh_tempo')>lewat_jatuh_tempo</option>
                <option value="batal" @selected(old('status', $monthlyBill->status) === 'batal')>batal</option>
            </select>
        </label>

        <label>
            Catatan
            <textarea name="catatan" rows="3">{{ old('catatan', $monthlyBill->catatan) }}</textarea>
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Update</button>
            <a href="{{ route('admin.bills.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection