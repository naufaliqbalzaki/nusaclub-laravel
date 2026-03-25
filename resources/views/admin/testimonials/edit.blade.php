@extends('admin.layouts.app')

@section('title', 'Edit Testimoni')

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
            <h3 style="margin-bottom:6px;">Edit Testimoni</h3>
            <p style="margin:0; color:var(--admin-muted);">
                Perbarui isi testimoni, rating, status moderasi, dan pengaturan featured.
            </p>
        </div>
    </div>

    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" class="daftar-form" style="max-width:100%;">
        @csrf
        @method('PUT')

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:24px;">
            <div>
                <label>Nama
                    <input type="text" name="nama" value="{{ old('nama', $testimonial->nama) }}" placeholder="Masukkan nama pemberi testimoni" required>
                </label>
            </div>

            <div>
                <label>Rating
                    <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $testimonial->rating) }}" required>
                </label>
            </div>
        </div>

        <label>Isi Testimoni
            <textarea name="isi" rows="5" placeholder="Tulis isi testimoni di sini..." required>{{ old('isi', $testimonial->isi) }}</textarea>
        </label>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:24px; align-items:end;">
            <div>
                <label>Status
                    <select name="status" required>
                        <option value="pending" @selected(old('status', $testimonial->status) === 'pending')>Pending</option>
                        <option value="approved" @selected(old('status', $testimonial->status) === 'approved')>Approved</option>
                        <option value="hidden" @selected(old('status', $testimonial->status) === 'hidden')>Hidden</option>
                        <option value="rejected" @selected(old('status', $testimonial->status) === 'rejected')>Rejected</option>
                    </select>
                </label>
            </div>

            <div>
                <label style="display:flex; align-items:center; gap:10px; font-weight:600; margin-top:30px;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }} style="width:auto;">
                    Jadikan sebagai featured testimonial
                </label>
            </div>
        </div>

        <div class="form-actions" style="margin-top:20px;">
            <button type="submit" class="btn btn-filled" style="padding:12px 18px; border:none;">
                <i class="fas fa-floppy-disk"></i>
                Update
            </button>

            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline" style="padding:12px 18px;">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection