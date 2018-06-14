<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\User;
use App\Ticket;
use App\Notification;
use App\NotifyType;

class StatusTicketRequested implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
     public $BuyerId;
     public $message;
     public $notification_id;
     public $is_accept;
     public $related_id;

    public function __construct($requestedTicket,$is_accept)

    {
        $this->Ticket=Ticket::find($requestedTicket->ticket_id)->first();
        $this->TicketName=$this->Ticket->name;
        $this->Quantity=$requestedTicket->quantity;
        $this->BuyerId=$requestedTicket->requester_id;
        $this->is_accept=$is_accept;

        $this->SellerId=User::find($requestedTicket->user_id)->first();
        $this->sellerName=$this->SellerId->name;
        if ($is_accept=="true"){

        $this->message = "{$this->sellerName} accept  Your ticket {$this->TicketName} with quantity= {$this->Quantity}";
        }
        else{
            $this->message = "{$this->sellerName} cancel Your ticket {$this->TicketName} with quantity= {$this->Quantity}";

        }
        $notify_type_id=NotifyType::where('type','=','tickets')->first()->id;
        $notification=  Notification::create([
                        'user_id' => $this->BuyerId,
                        'notify_type_id' => $notify_type_id,
                        'message'=>$this->message,
                        'related_id'=> $requestedTicket->ticket_id
                   ]);
        $this->notification_id=$notification->id;
        $this->related_id=$requestedTicket->ticket_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ('status-tickedrequest_'.$this->BuyerId);
    }
}
