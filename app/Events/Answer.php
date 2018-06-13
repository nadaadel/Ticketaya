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
use App\Event;

class Answer implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user_id;
    public $creator;
    public $eventname;
    public $message;
    public $notification_id;
    public function __construct($asker_id,$event_id)
    {
        $event=Event::find($event_id);
        $this->user_id=$asker_id;
        $this->creator=$event->user_id;
        $this->eventname=$event->name;
        $this->message=$event->user->name." updated answer to ".$this->eventname."event ";
        $notification=Notification::create([
            'user_id' => $this->creator,
            'notify_type_id' => 1,
            'message'=>$this->message
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
        return ['answer-notification_'.$this->user_id];
    }

}
