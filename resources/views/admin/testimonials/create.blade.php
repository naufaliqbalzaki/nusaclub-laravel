@extends('admin.layouts.app')

@section('title', 'Tambah Testimoni')

@section('content')
@if ($errors->any())
    <div class="admin-alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="table-card">
    <div class="admin-filterbar">
        <div>
            <h3 style="margin-bottom:6px;">Tambah Testimoni</h3>
            <p style="margin:0; color:var(--admin-muted);">
                Tambahkan testimoni baru yang nantinya dapat ditampilkan di halaman publik.
            </p>
        </div>
    </div>

    <form action="{{ route('admin.testimonials.store') }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:24px;">
            <div>
                <label>Nama
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama pemberi testimoni" required>
                </label>
            </div>

            <div>
                <label>Rating
                    <input type="number" name="rating" min="1" max="5" value="{{ old('rating', 5) }}" required>
                </label>
            </div>
        </div>

        <label>Isi Testimoni
            <textarea name="isi" rows="5" placeholder="Tulis isi testimoni di sini..." required>{{ old('isi') }}</textarea>
        </label>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:24px; align-items:end;">
            <div>
                <label>Status
                    <select name="status" required>
                        <option value="pending" @selected(old('status') === 'pending')>Pending</option>
                        <option value="approved" @selected(old('status') === 'approved')>Approved</option>
                        <option value="hidden" @selected(old('status') === 'hidden')>Hidden</option>
                        <option value="rejected" @selected(old('status') === 'rejected')>Rejected</option>
                    </select>
                </label>
            </div>

            <div>
                <label style="display:flex; align-items:center; gap:10px; font-weight:600; margin-top:30px;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width:auto;">
                    Jadikan sebagai featured testimonial
                </label>
            </div>
        </div>

        <div class="form-actions" style="margin-top:20px;">
            <button type="submit" class="btn btn-filled" style="padding:12px 18px; border:none;">
                <i class="fas fa-floppy-disk"></i>
                Simpan
            </button>

            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline" style="padding:12px 18px;">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection