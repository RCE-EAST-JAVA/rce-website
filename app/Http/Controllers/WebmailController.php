<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebmailController extends Controller
{
    /**
     * Single Sign-On (SSO) redirect to cPanel Webmail.
     * Generates a temporary session URL via cPanel UAPI if credentials are available.
     * Falls back to direct mail.rce-eastjava.com URL if API token is unconfigured or fails.
     */
    public function sso(Request $request)
    {
        $user = auth()->user();
        $fallbackUrl = 'https://mail.rce-eastjava.com';

        $cpanelHost = config('services.cpanel.host', 'mail.rce-eastjava.com');
        $cpanelUsername = config('services.cpanel.username');
        $cpanelApiToken = config('services.cpanel.api_token');
        $cpanelPort = config('services.cpanel.port', '2083');

        // Check if cPanel API credentials are setup in environment
        if (empty($cpanelUsername) || empty($cpanelApiToken)) {
            Log::info('cPanel API credentials not configured in .env. Falling back to direct Webmail URL.');
            return redirect()->away($fallbackUrl);
        }

        try {
            // Clean host format (remove http/https prefix if present)
            $cleanHost = preg_replace('/^https?:\/\//i', '', rtrim($cpanelHost, '/'));
            $apiUrl = "https://{$cleanHost}:{$cpanelPort}/execute/Session/create_temp_user_session";

            $response = Http::withHeaders([
                'Authorization' => "cpanel {$cpanelUsername}:{$cpanelApiToken}",
            ])
            ->withoutVerifying() // Prevent SSL verify errors during API call if self-signed
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

            Log::warning('cPanel API failed to generate session token', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        } catch (\Exception $e) {
            Log::error('Exception during cPanel Webmail SSO request: ' . $e->getMessage());
        }

        // Fallback gracefully to direct webmail URL if SSO token request failed
        return redirect()->away($fallbackUrl);
    }
}
