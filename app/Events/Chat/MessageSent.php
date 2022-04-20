<?php

namespace App\Events\Chat;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User that sent the message
     *
     * @var User
     */
    public User $user;

    public User $otherUser;

    /**
     * Message details
     *
     * @var ChatMessage
     */
    public ChatMessage $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, User $otherUser, ChatMessage $message)
    {
        $this->user = $user;
        $this->otherUser = $otherUser;
        $this->message = $message;
        dd($this->message);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->user->id);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return $this->message->toArray();
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }
}
