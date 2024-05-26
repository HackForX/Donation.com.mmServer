<?php

namespace App\Events;

use App\Models\NatebanzayChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(private NatebanzayChatMessage $chatMessage)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat' . $this->chatMessage->chat_id);
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->chatMessage->id,
            'chat_id' => (int) $this->chatMessage->chat_id,
            'receiver_id' => (int) $this->chatMessage->receiver_id,
            'sender_id' => (int) $this->chatMessage->sender_id,
            'created_at' => $this->chatMessage->created_at,
            'message' => $this->chatMessage->message
        ];
    }
}
