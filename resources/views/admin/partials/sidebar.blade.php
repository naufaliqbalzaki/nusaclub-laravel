@php
    $routeName = request()->route()?->getName();
@endphp

<aside class="admin-sidebar">
    <div class="admin-brand">
        <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo NusaClub">
        <div>
            <h2>NusaClub Admin</h2>
            <p>Panel Manajemen Website</p>
        </div>
    </div>

    <div class="admin-sidebar-section">Overview</div>
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="{{ $routeName === 'admin.dashboard' ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            Dashboard
        </a>
    </nav>

    <div class="admin-sidebar-section">Pendaftaran</div>
    <nav>
        <a href="{{ route('admin.pendaftarans.index') }}" class="{{ str_starts_with($routeName, 'admin.pendaftarans') ? 'active' : '' }}">
            <i class="fas fa-user-plus"></i>
            Pendaftaran
        </a>
        <a href="{{ route('admin.students.index') }}" class="{{ str_starts_with($routeName, 'admin.students') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            Siswa Aktif
        </a>
    </nav>

    <div class="admin-sidebar-section">Akademik</div>
    <nav>
        <a href="{{ route('admin.programs.index') }}" class="{{ str_starts_with($routeName, 'admin.programs') ? 'active' : '' }}">
            <i class="fas fa-layer-group"></i>
            Program
        </a>
        <a href="{{ route('admin.packages.index') }}" class="{{ str_starts_with($routeName, 'admin.packages') ? 'active' : '' }}">
            <i class="fas fa-box-open"></i>
            Paket
        </a>
        <a href="{{ route('admin.locations.index') }}" class="{{ str_starts_with($routeName, 'admin.locations') ? 'active' : '' }}">
            <i class="fas fa-location-dot"></i>
            Lokasi
        </a>
        <a href="{{ route('admin.coaches.index') }}" class="{{ str_starts_with($routeName, 'admin.coaches') ? 'active' : '' }}">
            <i class="fas fa-person-swimming"></i>
            Pelatih
        </a>
    </nav>

    <div class="admin-sidebar-section">Keuangan</div>
    <nav>
        <a href="{{ route('admin.bills.index') }}" class="{{ str_starts_with($routeName, 'admin.bills') ? 'active' : '' }}">
            <i class="fas fa-file-invoice-dollar"></i>
            Tagihan
        </a>
        <a href="{{ route('admin.payments.index') }}" class="{{ str_starts_with($routeName, 'admin.payments') ? 'active' : '' }}">
            <i class="fas fa-wallet"></i>
            Pembayaran
        </a>
    </nav>

    <div class="admin-sidebar-section">Konten</div>
    <nav>
        <a href="{{ route('admin.testimonials.index') }}" class="{{ str_starts_with($routeName, 'admin.testimonials') ? 'active' : '' }}">
            <i class="fas fa-comments"></i>
            Testimoni
        </a>
        <a href="{{ route('admin.faqs.index') }}" class="{{ str_starts_with($routeName, 'admin.faqs') ? 'active' : '' }}">
            <i class="fas fa-circle-question"></i>
            FAQ
        </a>
        <a href="{{ route('admin.settings.index') }}" class="{{ str_starts_with($routeName, 'admin.settings') ? 'active' : '' }}">
            <i class="fas fa-gear"></i>
            Konten Website
        </a>
    </nav>
</aside>