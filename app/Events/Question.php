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
use App\NotifyType;

class Question implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $user;
    public $creator_id;
    public $eventname;
    public $message;
    public $notification_id;
    public $related_id;


    public function __construct($asker,$event)
    {
        $this->user=$asker;
        $this->creator_id=$event->user_id;
        $this->eventname=$event->name;
        $this->message=$this->user->name." ask a question to ".$this->eventname."event ";
        $notify_type_id=NotifyType::where('type','=','events')->first()->id;
        $notification=Notification::create([
            'user_id' => $this->creator_id,
            'notify_type_id' => $notify_type_id,
            'message'=>$this->message,
            'related_id'=> $event_id
        ]);
        $this->notification_id=$notification->id;
        $this->related_id=$event_id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        return new Channel ('question-notification_'.$this->creator_id);
    }


}
