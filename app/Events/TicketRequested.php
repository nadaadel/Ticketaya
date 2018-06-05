<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Notification;
use App\Ticket;
use Auth;
class TicketRequested implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ticketName;
    public $fromUser;
    public $message;
    public $user_id;
    public $notification_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);
        $this->ticketName = $ticket->name;
        $this->fromUser =   Auth::user()->name;
        $this->user_id  =  $ticket->user_id;
        $this->message  = "{$this->fromUser} request Your ticket { $this->ticketName}";

        $notification = Notification::create([
           'user_id' => $this->user_id,
           'message' => "{$this->fromUser} request Your ticket {$this->ticketName}",
           'notify_type_id' => 1
        ]);
        $this->notification_id=$notification->id;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['ticket-requested_'.$this->user_id];
    }
}
