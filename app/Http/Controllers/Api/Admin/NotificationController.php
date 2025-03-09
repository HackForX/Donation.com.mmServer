<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return ResponseHelper::success(NotificationResource::collection($notifications));
    }
    public function store(Request $request)
    {
        $firebaseTokens = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = env('SERVER_API_KEY');


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
        // Get unique user IDs from tokens
        $userIds = User::whereNotNull('device_token')->pluck('id')->unique();

        // Store the notification once per user
        $notification = Notification::create([

            'title' => $request->title,
            'body' => $request->body
        ]);
        return ResponseHelper::success(NotificationResource::make($notification));
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
