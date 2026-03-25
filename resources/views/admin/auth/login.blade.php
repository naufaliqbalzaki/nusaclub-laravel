<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - NusaClub</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(14,165,233,0.30), transparent 28%),
                radial-gradient(circle at bottom right, rgba(2,132,199,0.22), transparent 28%),
                linear-gradient(135deg, #eff8ff 0%, #f8fafc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-shell {
            width: 100%;
            max-width: 980px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(255,255,255,0.7);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.12);
            backdrop-filter: blur(14px);
        }

        .login-side {
            padding: 42px;
            background: linear-gradient(135deg, #0ea5e9, #0369a1);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-side img {
            width: 72px;
            height: 72px;
            object-fit: contain;
            background: #fff;
            border-radius: 18px;
            padding: 10px;
            margin-bottom: 22px;
        }

        .login-side h1 {
            margin: 0 0 10px;
            font-size: 2.2rem;
            line-height: 1.2;
        }

        .login-side p {
            margin: 0;
            color: rgba(255,255,255,0.9);
            line-height: 1.7;
        }

        .login-card {
            padding: 42px 34px;
            background: transparent;
        }

        .login-card h2 {
            margin: 0 0 8px;
            font-size: 1.8rem;
            color: #0f172a;
        }

        .login-card .subtext {
            margin: 0 0 24px;
            color: #64748b;
        }

        .login-card label {
            display: block;
            margin-bottom: 16px;
            font-weight: 600;
            color: #0f172a;
        }

        .login-card input {
            width: 100%;
            padding: 13px 14px;
            margin-top: 7px;
            border: 1px solid #dbe4ee;
            border-radius: 14px;
            font-size: 0.95rem;
        }

        .login-card input:focus {
            outline: none;
            border-color: rgba(14,165,233,0.7);
            box-shadow: 0 0 0 4px rgba(14,165,233,0.12);
        }

        .login-alert {
            margin-bottom: 16px;
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 14px;
            border-radius: 12px;
        }

        .login-btn {
            width: 100%;
            border: none;
            cursor: pointer;
            padding: 14px 16px;
            border-radius: 14px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            box-shadow: 0 14px 28px rgba(14,165,233,0.24);
            transition: transform 0.2s ease;
        }

        .login-btn:hover {
            transform: translateY(-1px);
        }

        @media (max-width: 900px) {
            .login-shell {
                grid-template-columns: 1fr;
            }

            .login-side {
                padding: 28px;
            }

            .login-card {
                padding: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <div class="login-side">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo NusaClub">
            <h1>NusaClub Admin Panel</h1>
            <p>
                Kelola pendaftaran, siswa, paket, pembayaran, testimoni, FAQ, dan konten website
                dalam satu dashboard yang rapi dan modern.
            </p>
        </div>

        <div class="login-card">
            <h2>Login Admin</h2>
            <p class="subtext">Masuk untuk mengakses panel admin NusaClub.</p>

            @if ($errors->any())
                <div class="login-alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <label>
                    Email
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </label>

                <label>
                    Password
                    <input type="password" name="password" required>
                </label>

                <button type="submit" class="login-btn">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>
    </div>
</body>
</html>