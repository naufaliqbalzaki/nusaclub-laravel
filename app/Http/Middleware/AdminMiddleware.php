<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! $user->is_active) {
            abort(403, 'Akun admin tidak aktif.');
        }

        if (! in_array($user->role, ['super_admin', 'admin', 'finance', 'content_admin'], true)) {
            abort(403, 'Anda tidak memiliki akses admin.');
        }

        return $next($request);
    }
}