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
            if (isset($result['error'])) {
                $error = $result['error'];
                // Handle both old and new FCM error formats
                if (is_string($error) && in_array($error, ['NotRegistered', 'InvalidRegistration', 'UNREGISTERED']) ||
                    (is_array($error) && isset($error['message']) && 
                     (str_contains($error['message'], 'Requested entity was not found') ||
                      str_contains($error['message'], 'NotRegistered') ||
                      str_contains($error['message'], 'InvalidRegistration') ||
                      str_contains($error['message'], 'UNREGISTERED')))) {
                    $invalidTokens[] = $sentTokens[$index];
                    
                    \Log::warning('Invalid FCM token detected', [
                        'token' => $sentTokens[$index],
                        'error' => $error
                    ]);
                }
            }
        }

        if (!empty($invalidTokens)) {
            // Remove invalid tokens from database
            $updatedCount = User::whereIn('device_token', $invalidTokens)
                ->update(['device_token' => null]);
            
            \Log::info('Removed invalid FCM tokens', [
                'count' => count($invalidTokens),
                'updated_count' => $updatedCount,
                'tokens' => $invalidTokens
            ]);
        }
    }

    private function send(array $tokens, string $title, string $body)
    {
        $accessToken = $this->client->fetchAccessTokenWithAssertion()['access_token'];

        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

        // For multiple tokens, we need to send individual messages
        $responses = [];
        foreach ($tokens as $token) {
            $payload = [
                'message' => [
                    'token' => $token,
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
                \Log::error('FCM send failed for token', [
                    'token' => $token,
                    'response' => $response->json(),
                ]);
            }

            $responses[] = $response->body();
        }

        // Return a combined response that mimics the old format
        return json_encode([
            'results' => array_map(function($response) {
                $data = json_decode($response, true);
                return isset($data['error']) ? ['error' => $data['error']['message']] : ['message_id' => $data['name'] ?? null];
            }, $responses)
        ]);
    }
}
