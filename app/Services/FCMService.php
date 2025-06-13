<?php

namespace App\Services;

use Google\Client;
use Google\Service\FirebaseCloudMessaging;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class FCMService
{
    protected $client;
    protected $projectId;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/firebase/firebase-service-account.json'));
        $this->client->addScope('https://www.googleapis.com/auth/cloud-platform');
        $this->client->useApplicationDefaultCredentials();

        $this->projectId = env('FIREBASE_PROJECT_ID');
    }

    public function sendToTokens(array $tokens, string $title, string $body)
    {
        try {
            $response = $this->send($tokens, $title, $body);
            $responseData = json_decode($response, true);

            if (isset($responseData['results'])) {
                $this->handleInvalidTokens($tokens, $responseData['results']);
            }

            return $responseData;
        } catch (\Exception $e) {
            \Log::error('FCM send failed', [
                'error' => $e->getMessage(),
                'tokens' => $tokens
            ]);
            throw $e;
        }
    }

    private function handleInvalidTokens(array $sentTokens, array $results)
    {
        $invalidTokens = [];
        
        foreach ($results as $index => $result) {
            if (isset($result['error']) && 
                in_array($result['error'], ['NotRegistered', 'InvalidRegistration', 'UNREGISTERED'])) {
                $invalidTokens[] = $sentTokens[$index];
            }
        }

        if (!empty($invalidTokens)) {
            // Remove invalid tokens from database
            User::whereIn('device_token', $invalidTokens)
                ->update(['device_token' => null]);
            
            \Log::info('Removed invalid FCM tokens', [
                'count' => count($invalidTokens),
                'tokens' => $invalidTokens
            ]);
        }
    }

    private function send(array $tokens, string $title, string $body)
    {
        $accessToken = $this->client->fetchAccessTokenWithAssertion()['access_token'];

        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

        $payload = [
            'message' => [
                'tokens' => $tokens,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'android' => [
                    'priority' => 'high',
                ]
            ]
        ];

        $response = Http::withToken($accessToken)
            ->post($url, $payload);

        if (!$response->successful()) {
            \Log::error('FCM send failed', [
                'response' => $response->json(),
            ]);
        }

        return $response->body();
    }
}
