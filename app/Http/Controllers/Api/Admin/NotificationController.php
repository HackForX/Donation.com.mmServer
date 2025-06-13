<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

use App\Services\FCMService;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return ResponseHelper::success(NotificationResource::collection($notifications));
    }
    // public function store(Request $request)
    // {
    //     try {
    //         $firebaseTokens = User::whereNotNull('device_token')->pluck('device_token')->all();
            
    //         if (empty($firebaseTokens)) {
    //             return ResponseHelper::error('No device tokens found', 400);
    //         }

    //         $SERVER_API_KEY = env('FIREBASE_SERVER_KEY');
            
    //         if (empty($SERVER_API_KEY)) {
    //             return ResponseHelper::error('Firebase server key not configured', 500);
    //         }

    //         $data = [
    //             "registration_ids" => $firebaseTokens,
    //             "notification" => [
    //                 "title" => $request->title,
    //                 "body" => $request->body,
    //             ]
    //         ];
    //         $dataString = json_encode($data);

    //         $headers = [
    //             'Authorization: Bearer ',
    //             'Content-Type: application/json',
    //         ];

    //         $ch = curl_init();

    //         curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/donationcommm/messages:send');
    //         curl_setopt($ch, CURLOPT_POST, true);
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    //         $response = curl_exec($ch);
            
    //         if (curl_errno($ch)) {
    //             \Log::error('Firebase notification error: ' . curl_error($ch));
    //             return ResponseHelper::error('Failed to send notification: ' . curl_error($ch), 500);
    //         }

    //         curl_close($ch);

    //         $responseData = json_decode($response, true);
            
    //         if (!$responseData) {
    //             \Log::error('Invalid response from Firebase: ' . $response);
    //             return ResponseHelper::error('Invalid response from Firebase', 500);
    //         }

    //         // Store the notification
    //         $notification = Notification::create([
    //             'title' => $request->title,
    //             'body' => $request->body
    //         ]);

    //         \Log::info('Notification sent successfully', [
    //             'notification_id' => $notification->id,
    //             'firebase_response' => $responseData
    //         ]);

    //         return ResponseHelper::success([
    //             'notification' => NotificationResource::make($notification),
    //             'firebase_response' => $responseData
    //         ]);

    //     } catch (\Exception $e) {
    //         \Log::error('Notification error: ' . $e->getMessage());
    //         return ResponseHelper::error('Failed to send notification: ' . $e->getMessage(), 500);
    //     }
    // }



public function store(Request $request, FCMService $fcmService)
{
    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $tokens = User::whereNotNull('device_token')->pluck('device_token')->toArray();

        if (empty($tokens)) {
            return ResponseHelper::error('No device tokens found', 400);
        }

        $fcmResponse = $fcmService->sendToTokens($tokens, $request->title, $request->body);

        $notification = Notification::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return ResponseHelper::success(NotificationResource::make($notification));

    } catch (\Exception $e) {
        \Log::error('Notification error: ' . $e->getMessage());
        return ResponseHelper::error('Failed to send notification: ' . $e->getMessage(), 500);
    }
}


    public function destroy(string $id)
    {
        return $this->handleTransaction(function () use ($id) {
            $notification = Notification::findOrFail($id);
            $notification->delete();

            return $this->responseHelper->success($notification, "Notification Deleted Successfully");
        });
    }
}
