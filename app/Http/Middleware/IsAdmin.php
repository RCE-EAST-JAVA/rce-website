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
    public function handle(Request $request, Closure $next, ?string $module = null, ?string $action = 'view'): Response
    {
        $check = auth()->check();
        $user = auth()->user();

        \Illuminate\Support\Facades\Log::info('IS_ADMIN MIDDLEWARE CHECK', [
            'path' => $request->path(),
            'auth_check' => $check,
            'user_id' => $user ? $user->id : null,
            'role' => $user ? $user->role : null,
            'module' => $module,
            'action' => $action,
            'session_id' => $request->session()->getId(),
        ]);

        if ($check && $user->hasAdminAccess()) {
            if ($module && !$user->hasPermission($module, $action)) {
                \Illuminate\Support\Facades\Log::warning('MODULE ACCESS DENIED', [
                    'user_id' => $user->id,
                    'module' => $module,
                    'action' => $action,
                ]);
                return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki hak akses untuk modul ini.');
            }
            return $next($request);
        }

        \Illuminate\Support\Facades\Log::warning('IS_ADMIN ACCESS DENIED REDIRECTING TO HOME', [
            'auth_check' => $check,
            'user_role' => $user ? $user->role : null,
        ]);

        return redirect('/')->with('error', 'Anda tidak memiliki hak akses admin.');
    }
}
