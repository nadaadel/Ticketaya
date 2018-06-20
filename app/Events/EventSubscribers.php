<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Event;
use Auth;
use App\Notification;
use App\NotifyType;

class EventSubscribers implements ShouldBroadcast
{
    public $message;
    public $user_id;
    public $notification_id;
    public $related_id;
    public $notify_type;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($event_id , $toUser,$notify_type)
    {

      $event = Event::find($event_id);
      $this->message = "Event {$event->name} Has New informations don't miss it";
      $this->user_id = $toUser;
      $notify_type_id=NotifyType::where('type','=',$notify_type)->first()->id;
      $notification=  Notification::create([
        'user_id' => $this->user_id,
        'notify_type_id' => $notify_type_id,
        'message'=>$this->message,
        'related_id'=> $event_id
   ]);
       $this->notification_id=$notification->id;
       $this->related_id=$event_id;
       $this->notify_type=$notify_type;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('event-subscriber_'.$this->user_id);

    }
}
