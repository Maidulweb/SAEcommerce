<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessengerEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $receiver_id;
    public $chat_time;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $receiver_id, $chat_time)
    {
        $this->message = $message;
        $this->receiver_id = $receiver_id;
        $this->chat_time = $chat_time;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('messenger.'.$this->receiver_id),
        ];
    }

    function broadcastWith() : array
    {
      return [
           'message' => $this->message,
           'receiver_id' => $this->receiver_id,
           'sender_id' => auth()->user()->id,
           'image' => auth()->user()->image,
           'chat_time' => $this->chat_time,
      ];
    }
}
