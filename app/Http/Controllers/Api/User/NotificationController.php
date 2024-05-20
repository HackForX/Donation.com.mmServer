<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function saveToken(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'token' => 'required|string',
        ]);

        $user->update([
            'device_token' => $request->token,
        ]);

        // Prepare a custom response
        $responseData = [
            'message' => 'Device token saved successfully.',
        ];



        return response()->json($responseData, 200); // HTTP status code for success
    }
    public function notifications()
    {
        $user = Auth::user();
        // Assuming the notifications table has a 'created_at' column that we can filter on
        $notifications = $user->notifications()->where('created_at', '>=', $user->created_at)->get();
    
        return ResponseHelper::success(NotificationResource::collection($notifications));
    }
    
}
