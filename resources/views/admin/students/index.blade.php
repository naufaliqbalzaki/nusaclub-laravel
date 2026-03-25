@extends('admin.layouts.app')

@section('title', 'Siswa Aktif')

@section('content')
<div class="table-card">
    <div class="admin-filterbar">
        <div>
            <h3 style="margin-bottom:6px;">Daftar Siswa</h3>
            <p style="margin:0; color:var(--admin-muted);">
                Kelola data siswa aktif, program, paket, dan status keanggotaan.
            </p>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('admin.students.create') }}" class="btn btn-filled" style="padding:12px 16px;">
                <i class="fas fa-user-plus"></i>
                Tambah Siswa
            </a>
        </div>
    </div>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>WhatsApp</th>
                <th>Program</th>
                <th>Paket</th>
                <th>Status</th>
                <th>Tanggal Mulai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>
                        <strong>{{ $student->nama }}</strong><br>
                        <span style="color:var(--admin-muted); font-size:12px;">
                            ID Siswa: #{{ $student->id }}
                        </span>
                    </td>

                    <td>{{ $student->whatsapp }}</td>

                    <td>
                        <span class="badge" style="background:#eef6ff; color:#0f172a;">
                            {{ $student->program?->nama ?? '-' }}
                        </span>
                    </td>

                    <td>
                        <span class="badge" style="background:#f8fafc; color:#0f172a;">
                            {{ $student->package?->nama ?? '-' }}
                        </span>
                    </td>

                    <td>
                        @php
                            $statusColor = match($student->status) {
                                'aktif' => 'background:#dcfce7; color:#166534;',
                                'nonaktif' => 'background:#fee2e2; color:#991b1b;',
                                'cuti' => 'background:#fef3c7; color:#92400e;',
                                default => 'background:#eef2ff; color:#3730a3;',
                            };
                        @endphp

                        <span class="badge" style="{{ $statusColor }}">
                            {{ ucfirst($student->status) }}
                        </span>
                    </td>

                    <td>
                        {{ $student->tanggal_mulai ? \Carbon\Carbon::parse($student->tanggal_mulai)->format('d-m-Y') : '-' }}
                    </td>

                    <td>
                        <div style="display:flex; gap:8px; flex-wrap:wrap;">
                            <a href="{{ route('admin.students.edit', $student) }}"
                               class="btn btn-outline"
                               style="padding:10px 14px;">
                                <i class="fas fa-pen"></i>
                                Edit
                            </a>

                            <form action="{{ route('admin.students.destroy', $student) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus siswa ini?')"
                                  style="margin:0;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-filled"
                                        style="padding:10px 14px; border:none; background:linear-gradient(135deg,#ef4444,#dc2626); box-shadow:0 12px 24px rgba(220,38,38,0.18);">
                                    <i class="fas fa-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="admin-empty">Belum ada siswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:18px;">
        {{ $students->links('vendor.pagination.admin') }}
    </div>
</div>
@endsection