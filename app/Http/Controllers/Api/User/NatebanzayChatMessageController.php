<?php

namespace App\Http\Controllers\Api\User;


use App\Events\NewMessageSent;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\NatebanzayChatMesssage\CreateNatebanzayChatMessageRequest;
use App\Http\Resources\NatebanzayChatMessageResource;
use App\Models\NatebanzayChat;
use App\Models\NatebanzayChatMessage;
use Illuminate\Http\Request;

class NatebanzayChatMessageController extends Controller
{
    public function store(CreateNatebanzayChatMessageRequest $request)
    {
        return $this->handleTransaction(function () use ($request) {
            $chatMessage = $request->all();
            $chatMessage = NatebanzayChatMessage::create($chatMessage);
            broadcast((new NewMessageSent($chatMessage)))->toOthers();
            return $this->responseHelper->success($chatMessage->load('sender'), "Sent Message Successfully");
        });
    }



    public function index(string $id)
    {

        $natebanzayChat = NatebanzayChat::where('id', $id)->first();
        $messages = NatebanzayChatMessage::where('chat_id', $natebanzayChat->id)->get();

        return ResponseHelper::success(NatebanzayChatMessageResource::collection($messages));
    }
}
