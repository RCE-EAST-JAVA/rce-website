<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\HeroPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $heroPhotos = HeroPhoto::active()->get();
        return view('auth.login', compact('heroPhotos'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        \Illuminate\Support\Facades\Log::info('LOGIN ATTEMPT STARTED', [
            'login' => $request->input('login') ?? $request->input('email') ?? $request->input('username'),
        ]);

        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();
        \Illuminate\Support\Facades\Log::info('LOGIN AUTHENTICATED SUCCESSFULLY', [
            'user_id' => $user ? $user->id : null,
            'email' => $user ? $user->email : null,
            'role' => $user ? $user->role : null,
            'session_id' => $request->session()->getId(),
        ]);

        if ($user && strtolower($user->role) === 'admin') {
            \Illuminate\Support\Facades\Log::info('REDIRECTING TO /admin RELATIVE');
            return redirect('/admin');
        }

        \Illuminate\Support\Facades\Log::info('REDIRECTING TO /portal/profile RELATIVE');
        return redirect('/portal/profile');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
