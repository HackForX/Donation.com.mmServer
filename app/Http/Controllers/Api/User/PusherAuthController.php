<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Pusher\Pusher;

class PusherAuthController extends Controller
{
    public function authenticate(Request $request)
    {
        // Log incoming request data for debugging
        Log::info('Pusher Auth Request', [
            'socket_id' => $request->socket_id,
            'channel_name' => $request->channel_name
        ]);

        // Validate request data
        $request->validate([
            'socket_id' => 'required|string',
            'channel_name' => 'required|string',
        ]);

        if (Auth::check()) {
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                [
                    'cluster' => env('PUSHER_APP_CLUSTER'),
                    'useTLS' => true
                ]
            );

            $channelName = $request->input('channel_name');
            $socketId = $request->input('socket_id');

            // Check for null values and handle appropriately
            if (!$channelName || !$socketId) {
                Log::error('Invalid channel name or socket ID', [
                    'channel_name' => $channelName,
                    'socket_id' => $socketId
                ]);
                return response()->json(['error' => 'Invalid channel name or socket ID'], 400);
            }

            $auth = $pusher->socket_auth($channelName, $socketId);
            return response($auth);
        } else {
            return response('Unauthorized', 401);
        }
    }
}
