<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\NatebanzayChatResource;
use App\Models\NatebanzayChat;
use Illuminate\Http\Request;

class NatebanzayChatController extends Controller
{
    public function index(Request $request)
    {
        $natebanzayChat = NatebanzayChat::where('requester_id', $request->requester_id)->where('uploader_id', $request->uploader_id)->firstOrFail();
        return ResponseHelper::success(NatebanzayChatResource::make($natebanzayChat));
    }
}
