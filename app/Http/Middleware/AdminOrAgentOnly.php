<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOrAgentOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    // $user = auth()->user();

    // if (!$user) {
    //     logger()->warning('User belum login.');
    //     abort(403, 'Akses ditolak. Anda belum login.');
    // }

    // if (!in_array($user->role, ['admin', 'agent'])) {
    //     logger()->warning('User tidak memiliki akses. Role: ' . $user->role);
    //     abort(403, 'Akses ditolak. Ini area khusus Admin dan Agent saja.');
    // }

    return $next($request);
}
}
