<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BimbinganSsoController extends Controller
{
    /**
     * Generate a one-time SSO token and redirect user to the Bimbingan portal.
     */
    public function redirect(Request $request)
    {
        $user = auth()->user();

        // Only users with sync_bimbingan enabled can SSO
        if (!$user || !$user->sync_bimbingan) {
            return back()->with('error', 'Akun Anda tidak memiliki akses ke Sistem Bimbingan. Hubungi administrator untuk mengaktifkan sinkronisasi bimbingan.');
        }

        // Generate a secure one-time token (64 char hex)
        $token = Str::random(64);

        // Save token with 60-second expiry to the shared rce_db
        $user->update([
            'sso_token' => hash('sha256', $token),
            'sso_token_expires_at' => Carbon::now()->addSeconds(60),
        ]);

        // Redirect to the Bimbingan portal SSO endpoint
        $bimbinganUrl = config('services.bimbingan.url', 'https://bimbingan.rce-eastjava.org');
        
        return redirect()->away("{$bimbinganUrl}/sso/login?token={$token}");
    }
}
