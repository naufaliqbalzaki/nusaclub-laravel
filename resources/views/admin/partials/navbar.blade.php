@php
    $pageTitle = trim($__env->yieldContent('title', 'Dashboard Admin'));
    $userName = auth()->user()->name ?? 'Admin';
    $initial = strtoupper(substr($userName, 0, 1));
@endphp

<div class="admin-topbar">
    <div>
        <h1>{{ $pageTitle }}</h1>
        <p>Kelola data NusaClub dengan tampilan yang lebih modern dan rapi.</p>
    </div>

    <div class="admin-userbox">
        <div style="display:flex; align-items:center; gap:12px;">
            <div class="admin-avatar">{{ $initial }}</div>
            <div class="admin-usertext">
                <strong>{{ $userName }}</strong>
                <span>{{ auth()->user()->email ?? 'Administrator' }}</span>
            </div>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="btn btn-filled" style="border:none; cursor:pointer; padding:12px 18px;">
                <i class="fas fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>
</div>