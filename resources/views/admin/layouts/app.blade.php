<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin NusaClub')</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-bg: #f4f7fb;
            --admin-card: #ffffff;
            --admin-text: #0f172a;
            --admin-muted: #64748b;
            --admin-border: #e2e8f0;
            --admin-primary: #0ea5e9;
            --admin-primary-dark: #0284c7;
            --admin-sidebar: #0f172a;
            --admin-sidebar-soft: #1e293b;
            --admin-success: #16a34a;
            --admin-warning: #d97706;
            --admin-danger: #dc2626;
            --admin-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            --admin-radius: 20px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #f8fbff 0%, var(--admin-bg) 100%);
            color: var(--admin-text);
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 280px;
            background:
                radial-gradient(circle at top left, rgba(14,165,233,0.18), transparent 32%),
                linear-gradient(180deg, #0f172a 0%, #111827 100%);
            color: #fff;
            padding: 28px 20px;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 10px 0 30px rgba(15, 23, 42, 0.12);
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
        }

        .admin-brand img {
            width: 54px;
            height: 54px;
            object-fit: contain;
            background: #fff;
            border-radius: 14px;
            padding: 6px;
        }

        .admin-brand h2 {
            margin: 0;
            font-size: 1.45rem;
            line-height: 1.2;
        }

        .admin-brand p {
            margin: 4px 0 0;
            font-size: 0.83rem;
            color: rgba(255,255,255,0.7);
        }

        .admin-sidebar-section {
            margin-top: 24px;
            margin-bottom: 12px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            padding: 0 12px;
        }

        .admin-sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .admin-sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.82);
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 14px;
            font-weight: 500;
            transition: all 0.25s ease;
        }

        .admin-sidebar a:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
            transform: translateX(3px);
        }

        .admin-sidebar a.active {
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-primary-dark));
            color: #fff;
            box-shadow: 0 10px 24px rgba(14, 165, 233, 0.28);
        }

        .admin-sidebar a i {
            width: 18px;
            text-align: center;
            font-size: 0.95rem;
        }

        .admin-content {
            flex: 1;
            padding: 28px;
            min-width: 0;
        }

        .admin-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            background: rgba(255,255,255,0.82);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(226,232,240,0.9);
            border-radius: 22px;
            padding: 18px 22px;
            box-shadow: var(--admin-shadow);
            margin-bottom: 24px;
        }

        .admin-topbar h1 {
            margin: 0;
            font-size: 1.55rem;
            line-height: 1.2;
        }

        .admin-topbar p {
            margin: 4px 0 0;
            color: var(--admin-muted);
            font-size: 0.92rem;
        }

        .admin-userbox {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .admin-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-primary-dark));
            color: #fff;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(14, 165, 233, 0.25);
        }

        .admin-usertext {
            display: flex;
            flex-direction: column;
            line-height: 1.25;
        }

        .admin-usertext strong {
            font-size: 0.95rem;
        }

        .admin-usertext span {
            color: var(--admin-muted);
            font-size: 0.82rem;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            background: var(--admin-card);
            border: 1px solid var(--admin-border);
            padding: 22px;
            border-radius: var(--admin-radius);
            box-shadow: var(--admin-shadow);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 110px;
            height: 110px;
            background: rgba(14,165,233,0.08);
            border-radius: 50%;
        }

        .stat-card h4 {
            margin: 0 0 10px;
            font-size: 0.95rem;
            color: var(--admin-muted);
            font-weight: 600;
        }

        .stat-card h2 {
            margin: 0;
            font-size: 2rem;
            font-weight: 800;
            color: var(--admin-text);
        }

        .table-card {
            background: var(--admin-card);
            border: 1px solid var(--admin-border);
            padding: 22px;
            border-radius: var(--admin-radius);
            box-shadow: var(--admin-shadow);
            overflow-x: auto;
            margin-bottom: 24px;
        }

        .table-card h3 {
            margin-top: 0;
            margin-bottom: 18px;
            font-size: 1.15rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 760px;
        }

        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid #edf2f7;
            text-align: left;
            vertical-align: middle;
            font-size: 0.94rem;
        }

        th {
            background: #f8fbff;
            color: #0f172a;
            font-weight: 700;
            position: sticky;
            top: 0;
        }

        tr:hover td {
            background: #fbfdff;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-baru { background: #dbeafe; color: #1d4ed8; }
        .badge-dihubungi { background: #fef3c7; color: #92400e; }
        .badge-trial { background: #ede9fe; color: #7c3aed; }
        .badge-diterima, .badge-aktif { background: #dcfce7; color: #166534; }
        .badge-batal { background: #fee2e2; color: #991b1b; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-filled {
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-primary-dark));
            color: #fff;
            border: none;
            box-shadow: 0 12px 24px rgba(14, 165, 233, 0.22);
        }

        .btn-filled:hover {
            transform: translateY(-1px);
            filter: brightness(1.02);
        }

        .btn-outline {
            background: #fff;
            color: var(--admin-text);
            border: 1px solid var(--admin-border);
        }

        .btn-outline:hover {
            background: #f8fbff;
            border-color: #cbd5e1;
        }

        input, select, textarea {
            width: 100%;
            border: 1px solid #dbe4ee;
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 0.95rem;
            background: #fff;
            color: var(--admin-text);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: rgba(14,165,233,0.7);
            box-shadow: 0 0 0 4px rgba(14,165,233,0.12);
        }

        textarea {
            resize: vertical;
        }

        .daftar-form {
            gap: 1.2rem;
            background: transparent;
            box-shadow: none;
            padding: 0;
            max-width: 100%;
            border: none;
            margin: 0;
        }

        .daftar-form label {
            font-size: 0.92rem;
            font-weight: 600;
            color: #0f172a;
            gap: 0.5rem;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 10px;
        }

        .admin-filterbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .admin-filterbar form {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        .admin-alert-success {
            margin-bottom: 16px;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 14px 16px;
            border-radius: 14px;
        }

        .admin-alert-error {
            margin-bottom: 16px;
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 14px 16px;
            border-radius: 14px;
        }

        .admin-alert-error ul {
            margin: 0;
            padding-left: 18px;
        }

        .admin-empty {
            text-align: center;
            color: var(--admin-muted);
            padding: 28px 10px;
        }

        .pagination {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        @media (max-width: 1100px) {
            .admin-sidebar {
                width: 240px;
            }
        }

        @media (max-width: 900px) {
            .admin-wrapper {
                flex-direction: column;
            }

            .admin-sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-radius: 0 0 22px 22px;
            }

            .admin-content {
                padding: 18px;
            }

            .admin-topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .admin-userbox {
                width: 100%;
                justify-content: space-between;
            }
        }

        .admin-pagination-wrapper {
        margin-top: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        }

        .admin-pagination-info {
        color: var(--admin-muted);
        font-size: 0.92rem;
        }

        .admin-pagination-links {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
        }

        .admin-page-btn,
        .admin-page-number,
        .admin-page-dots {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 42px;
        padding: 0 14px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.92rem;
        border: 1px solid var(--admin-border);
        background: #fff;
        color: var(--admin-text);
        transition: all 0.2s ease;
        }

        .admin-page-btn:hover,
        .admin-page-number:hover {
        background: #f8fbff;
        border-color: #cbd5e1;
        }

        .admin-page-number.active {
        background: linear-gradient(135deg, var(--admin-primary), var(--admin-primary-dark));
        color: #fff;
        border-color: transparent;
        box-shadow: 0 10px 24px rgba(14, 165, 233, 0.22);
        }

        .admin-page-btn.disabled {
        opacity: 0.45;
        cursor: not-allowed;
        pointer-events: none;
        }

        .admin-page-dots {
        background: transparent;
        border: none;
        min-width: auto;
        padding: 0 4px;
        }

        @media (max-width: 768px) {
        .admin-pagination-wrapper {
            flex-direction: column;
            align-items: flex-start;
        }

        .admin-pagination-links {
            width: 100%;
        }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        @include('admin.partials.sidebar')

        <main class="admin-content">
            @include('admin.partials.navbar')

            @if (session('success'))
                <div class="admin-alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>