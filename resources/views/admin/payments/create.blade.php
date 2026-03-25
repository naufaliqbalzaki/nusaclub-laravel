@extends('admin.layouts.app')

@section('title', 'Input Pembayaran')

@section('content')
<div class="table-card">
    <h3 style="margin-bottom:16px;">Input Pembayaran</h3>

    @if ($errors->any())
        <div style="margin-bottom:16px; background:#fee2e2; color:#991b1b; padding:12px 14px; border-radius:12px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data" class="daftar-form" style="max-width:100%;">
        @csrf

        <label>
            Tagihan
            <select name="monthly_bill_id" required>
                <option value="">-- Pilih Tagihan --</option>
                @foreach ($bills as $bill)
                    @php
                        $paid = $bill->payments_sum_nominal_bayar ?? 0;
                        $remaining = max(0, $bill->total - $paid);
                    @endphp
                    <option value="{{ $bill->id }}" {{ old('monthly_bill_id') == $bill->id ? 'selected' : '' }}>
                        {{ $bill->student?->nama ?? '-' }} - {{ $bill->bill_month }}/{{ $bill->bill_year }} - Sisa Rp{{ number_format($remaining, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>
            Tanggal Bayar
            <input type="date" name="tanggal_bayar" value="{{ old('tanggal_bayar', now()->format('Y-m-d')) }}" required>
        </label>

        <label>
            Nominal Bayar
            <input type="number" step="0.01" name="nominal_bayar" value="{{ old('nominal_bayar') }}" required>
        </label>

        <label>
            Metode Pembayaran
            <select name="metode_pembayaran" required>
                <option value="transfer" @selected(old('metode_pembayaran') === 'transfer')>transfer</option>
                <option value="cash" @selected(old('metode_pembayaran') === 'cash')>cash</option>
                <option value="qris" @selected(old('metode_pembayaran') === 'qris')>qris</option>
            </select>
        </label>

        <label>
            Reference No
            <input type="text" name="reference_no" value="{{ old('reference_no') }}">
        </label>

        <label>
            Bukti Bayar
            <input type="file" name="bukti_bayar" accept=".jpg,.jpeg,.png,.pdf">
            <small style="color:#6b7280;">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
        </label>

        <label>
            Catatan
            <textarea name="catatan" rows="3">{{ old('catatan') }}</textarea>
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-filled">Simpan</button>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-outline">Kembali</a>
        </div>
    </form>
</div>
@endsection