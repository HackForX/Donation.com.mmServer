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
            // Get Pusher credentials from config
            $appKey = config('broadcasting.connections.pusher.key');
            $appSecret = config('broadcasting.connections.pusher.secret');
            $appId = config('broadcasting.connections.pusher.app_id');
            $appCluster = config('broadcasting.connections.pusher.options.cluster');

            // Validate Pusher credentials
            if (!$appKey || !$appSecret || !$appId || !$appCluster) {
                Log::error('Pusher credentials are not properly configured', [
                    'key_exists' => !empty($appKey),
                    'secret_exists' => !empty($appSecret),
                    'app_id_exists' => !empty($appId),
                    'cluster_exists' => !empty($appCluster)
                ]);
                return response()->json(['error' => 'Pusher configuration is incomplete'], 500);
            }

            try {
                $pusher = new Pusher(
                    $appKey,
                    $appSecret,
                    $appId,
                    [
                        'cluster' => $appCluster,
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
            } catch (\Exception $e) {
                Log::error('Pusher authentication failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return response()->json(['error' => 'Pusher authentication failed'], 500);
            }
        } else {
            return response('Unauthorized', 401);
        }
    }
}
