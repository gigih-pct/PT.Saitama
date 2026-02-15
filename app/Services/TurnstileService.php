<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TurnstileService
{
    /**
     * Verify Cloudflare Turnstile token
     *
     * @param string $token
     * @param string|null $remoteIp
     * @return bool
     */
    public function verify(string $token, ?string $remoteIp = null): bool
    {
        $secretKey = config('turnstile.secret_key');
        $verifyUrl = config('turnstile.verify_url');

        if (empty($secretKey)) {
            \Log::error('Turnstile secret key is not configured');
            return false;
        }

        try {
            $response = Http::asForm()->post($verifyUrl, [
                'secret' => $secretKey,
                'response' => $token,
                'remoteip' => $remoteIp,
            ]);

            if (!$response->successful()) {
                \Log::error('Turnstile verification failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return false;
            }

            $data = $response->json();

            return $data['success'] ?? false;
        } catch (\Exception $e) {
            \Log::error('Turnstile verification exception', [
                'message' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
