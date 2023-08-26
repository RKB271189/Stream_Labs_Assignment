<?php

namespace App\Repository;

use Illuminate\Support\Facades\Http;

class GoogleRepository
{
    public function exchangeCodeForToken(string $authCode)
    {
        $response = Http::post('https://oauth2.googleapis.com/token', [
            'code' => $authCode,
            'client_id' => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
            'redirect_uri' => config('services.google.redirect_url'),
            'grant_type' => 'authorization_code',
        ]);

        return $response->json();
    }
    public function processUser(string $accessToken)
    {
        $response = Http::get('https://www.googleapis.com/oauth2/v2/userinfo', [
            'access_token' => $accessToken,
        ]);
        return $response->json();
    }
}
