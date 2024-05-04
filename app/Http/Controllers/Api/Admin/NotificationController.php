<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    
    public function sendNotifications(Request $request)
    {
        $firebaseTokens = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = $_ENV['SERVER_API_KEY'];

        $data = [
            "registration_ids" => $firebaseTokens,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        foreach ($firebaseTokens as $token) {
            Notification::create([
                'user_id' => User::where('device_token', $token)->first()->id, // Get user ID for each token
                'title' => $request->title,
                'body' => $request->body
            ]);
        }

        return ResponseHelper::success("Succesfully sent");
    }
}
