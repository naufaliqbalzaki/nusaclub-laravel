@extends('layouts.app')

@section('title', 'Data Pendaftaran - NusaClub')
@section('meta_description', 'Data pendaftaran peserta NusaClub.')

@section('content')
<section class="section fade-in">
    <div class="container">
        <h2 class="section-title">Data Pendaftaran</h2>
        <p class="section-subtitle">Total pendaftar: {{ $pendaftarans->count() }}</p>

        <div style="overflow-x:auto; background:#fff; border-radius:16px; padding:1rem; box-shadow:0 10px 24px rgba(0,0,0,0.06);">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:#0077b6; color:#fff;">
                        <th style="padding:12px; text-align:left;">No</th>
                        <th style="padding:12px; text-align:left;">Nama</th>
                        <th style="padding:12px; text-align:left;">WhatsApp</th>
                        <th style="padding:12px; text-align:left;">Usia</th>
                        <th style="padding:12px; text-align:left;">Program</th>
                        <th style="padding:12px; text-align:left;">Lokasi</th>
                        <th style="padding:12px; text-align:left;">Catatan</th>
                        <th style="padding:12px; text-align:left;">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftarans as $item)
                        <tr style="border-bottom:1px solid #e5e7eb;">
                            <td style="padding:12px;">{{ $loop->iteration }}</td>
                            <td style="padding:12px;">{{ $item->nama }}</td>
                            <td style="padding:12px;">{{ $item->whatsapp }}</td>
                            <td style="padding:12px;">{{ $item->usia }}</td>
                            <td style="padding:12px;">
                                @if ($item->program === 'beginner')
                                    Dasar Renang
                                @elseif ($item->program === 'intermediate')
                                    Teknik Menengah
                                @else
                                    Kompetisi
                                @endif
                            </td>
                            <td style="padding:12px;">{{ $item->lokasi }}</td>
                            <td style="padding:12px;">{{ $item->catatan ?: '-' }}</td>
                            <td style="padding:12px;">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="padding:16px; text-align:center;">Belum ada data pendaftaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection