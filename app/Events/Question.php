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
    public $notify_type;


    public function __construct($asker,$event,$notify_type)
    {
        $this->user=$asker;
        $this->creator_id=$event->user_id;
        $this->eventname=$event->name;
        $this->message=$this->user->name." ask a question to ".$this->eventname."event ";
        $notify_type_id=NotifyType::where('type','=',$notify_type)->first();

        $notification=Notification::create([
            'user_id' => $this->creator_id,
            'notify_type_id' => $notify_type_id->id,
            'message'=>$this->message,
            'related_id'=> $event->id
        ]);
        $this->notification_id=$notification->id;
        $this->related_id=$event->id;
        $this->notify_type=$notify_type;

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
