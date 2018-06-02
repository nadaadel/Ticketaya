<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TicketRequested implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ticketName;
    public $fromUser;
    public $message;
    public $user_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ticketName , $fromUser , $toUser_id)
    {
        $this->ticketName = $ticketName;
        $this->message = "{$fromUser} request Your ticket {$ticketName}";
        $this->user_id = $toUser_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        //    return ['ticket-requested'];
        return ['ticket-requested'.$this->user_id];

    }
}
