<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $check = auth()->check();
        $user = auth()->user();

        \Illuminate\Support\Facades\Log::info('IS_ADMIN MIDDLEWARE CHECK', [
            'path' => $request->path(),
            'auth_check' => $check,
            'user_id' => $user ? $user->id : null,
            'role' => $user ? $user->role : null,
            'session_id' => $request->session()->getId(),
        ]);

        if ($check && strtolower($user->role) === 'admin') {
            return $next($request);
        }

        \Illuminate\Support\Facades\Log::warning('IS_ADMIN ACCESS DENIED REDIRECTING TO HOME', [
            'auth_check' => $check,
            'user_role' => $user ? $user->role : null,
        ]);

        return redirect('/')->with('error', 'Anda tidak memiliki hak akses admin.');
    }
}
