<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebmailController extends Controller
{
    /**
     * Single Sign-On (SSO) & Direct Auto-Login to cPanel Webmail.
     * Uses saved user webmail credentials first, falls back to cPanel API token,
     * or redirects to direct Webmail login URL.
     */
    public function sso(Request $request)
    {
        $user = auth()->user();
        $fallbackUrl = 'https://mail.rce-eastjava.org';

        // 1. Direct Auto-Login using saved user credentials in Profile
        if ($user && !empty($user->webmail_password)) {
            $emailUser = !empty($user->webmail_username) ? $user->webmail_username : $user->email;
            $emailPass = $user->webmail_password; // Automatically decrypted by Laravel model cast 'encrypted'

            return response()->make(
                '<!DOCTYPE html>
                <html lang="id">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Menghubungkan ke Webmail RCE East Java...</title>
                    <style>
                        body { font-family: "Outfit", system-ui, -apple-system, sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; background: #f8faf8; color: #1e4620; }
                        .loader-card { text-align: center; padding: 2.5rem; background: #ffffff; border-radius: 1rem; box-shadow: 0 4px 20px rgba(30,70,32,0.08); max-width: 420px; width: 90%; border: 1px solid #e9f0ea; }
                        .spinner { width: 44px; height: 44px; border: 4px solid rgba(30, 70, 32, 0.15); border-top-color: #1e4620; border-radius: 50%; animation: spin 0.9s linear infinite; margin: 0 auto 1.25rem; }
                        @keyframes spin { to { transform: rotate(360deg); } }
                        h3 { margin: 0 0 0.5rem; font-size: 1.2rem; font-weight: 700; }
                        p { margin: 0; font-size: 0.875rem; color: #6b7280; }
                        .btn-manual { margin-top: 1.25rem; padding: 0.6rem 1.2rem; background: #1e4620; color: white; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; font-size: 0.875rem; }
                    </style>
                </head>
                <body onload="document.getElementById(\'webmail-form\').submit();">
                    <div class="loader-card">
                        <div class="spinner"></div>
                        <h3>Otentikasi Webmail...</h3>
                        <p>Membuka inbox email (' . htmlspecialchars($emailUser) . ') secara langsung.</p>
                        <form id="webmail-form" method="POST" action="https://mail.rce-eastjava.org:2096/login/">
                            <input type="hidden" name="user" value="' . htmlspecialchars($emailUser) . '">
                            <input type="hidden" name="pass" value="' . htmlspecialchars($emailPass) . '">
                            <input type="hidden" name="goto_uri" value="/">
                            <noscript>
                                <button type="submit" class="btn-manual">Klik di sini jika tidak beralih otomatis</button>
                            </noscript>
                        </form>
                    </div>
                </body>
                </html>'
            );
        }

        // 2. Fallback to cPanel API Token if setup in .env
        $cpanelHost = config('services.cpanel.host', 'mail.rce-eastjava.org');
        $cpanelUsername = config('services.cpanel.username');
        $cpanelApiToken = config('services.cpanel.api_token');
        $cpanelPort = config('services.cpanel.port', '2083');

        if (!empty($cpanelUsername) && !empty($cpanelApiToken)) {
            try {
                $cleanHost = preg_replace('/^https?:\/\//i', '', rtrim($cpanelHost, '/'));
                $apiUrl = "https://{$cleanHost}:{$cpanelPort}/execute/Session/create_temp_user_session";

                $response = Http::withHeaders([
                    'Authorization' => "cpanel {$cpanelUsername}:{$cpanelApiToken}",
                ])
                ->withoutVerifying()
                ->timeout(8)
                ->post($apiUrl, [
                    'app' => 'webmail',
                    'service' => 'webmail',
                    'user' => $user ? $user->email : '',
                ]);

                if ($response->successful()) {
                    $responseData = $response->json();
                    if (isset($responseData['status']) && $responseData['status'] == 1 && !empty($responseData['data']['url'])) {
                        return redirect()->away($responseData['data']['url']);
                    }
                }
            } catch (\Exception $e) {
                Log::error('Exception during cPanel Webmail SSO request: ' . $e->getMessage());
            }
        }

        // 3. Fallback: Prompt user to configure webmail password in profile
        return redirect()->route('portal.profile')->with('info', 'Silakan atur Password Webmail Anda terlebih dahulu untuk mengaktifkan fitur 1-Klik Direct Login Webmail.');
    }
}
