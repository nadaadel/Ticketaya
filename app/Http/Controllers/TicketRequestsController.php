<?php

namespace App\Http\Controllers;
use DB;
use App\Ticket;
use App\User;
use Image;
use Auth;
use App\Category;
use App\RequestedTicket;
use App\SoldTicket;
use App\Tag;
use App\Notification;
use App\Events\TicketRequested;
use App\Events\TicketReceived;
use App\Events\StatusTicketRequested;
use Illuminate\Http\Request;

class TicketRequestsController extends Controller
{
    public function requestTicket(Request $request ,$id){
        $ticket = Ticket::find($id);
        $quantity=$request->quantity;
        if ($quantity<=$ticket->quantity && $quantity!=0){

        RequestedTicket::create([
            'ticket_id' => $id,
            'user_id' => $ticket->user_id,
            'requester_id' => Auth::user()->id,
            'quantity' => $request->quantity ,
        ]);
        $request="true";

        // send request notification to ticket author
        event(new TicketRequested($id));

        return response()->json(['response' => 'ok']);
        //flashy()->error('your request is sent');
        }
        return response()->json(['quantity' =>$ticket->quantity ]);
        //flashy()->error('your request must be < $ticket->quantity .and >0');


    }
    public function getUserRequests(Request $request){
        /** User Tickets received Requests */
        $userRequestsReceived =RequestedTicket::all()->where('user_id' , '=' , Auth::user()->id);
        $userTicketsSold = SoldTicket::all()->where('user_id' , '=' , Auth::user()->id);

        /** User Tickets Send Requests */
        $userRequestsWanted = RequestedTicket::all()->where('requester_id' , '=' , Auth::user()->id);
        $userTicketsBought = SoldTicket::all()->where('buyer_id' , '=' , Auth::user()->id);

         return view('tickets.userRequests' , compact('userRequestsReceived' , 'userTicketsSold' ,
        'userRequestsWanted' , 'userTicketsBought'));
        }

            //add notification when accept aticket

    public function acceptTicket($id , $requester_id){
        $user = User::find(Auth::user()->id);

        $request = $user->requestedTicket()->where('requester_id' , '=' , $requester_id)
                                            ->where('is_accepted','=',0)->first();
        $request->pivot->is_accepted = 1;
        $request->pivot->save();
        $requestedTicket=RequestedTicket::all()->where('requester_id' , '=' , $requester_id)->first();
        $is_accept=true;
        event(new StatusTicketRequested( $requestedTicket,$is_accept));

        return redirect('/tickets/requests');
    }
        //to edit quantity in ticket request
        public function editRequestedTicket(Request $request,$id){
            $ticket = Ticket::find($request->ticket_id);
            if ($request->quantity<=$ticket->quantity && $request->quantity!=0){
            $user = User::find($ticket->user_id);
            $requestTicket = $user->requestedTicket()->where('requester_id' , '=' ,Auth::user()->id)->first();
            $requestTicket->pivot->quantity =$request->quantity;
            $requestTicket->pivot->save();

            event(new TicketRequested($request->ticket_id));

            return response()->json(['response' => 'ok']);
            //flashy()->error('your request is sent');

            }
            return response()->json(['quantity' =>$ticket->quantity ]);
            //flashy()->error('your request must be <'.$ticket->quantity .'and >0');


        }
        public function cancelTicketRequest($id , $requester_id){
            $user = User::find(Auth::user()->id);

            $allrequest = $user->requestedTicket()->where('requester_id' , '=' , $requester_id)
                                                  ->where('is_accepted','=',0)->first();



            $is_accept=false;
            $requestedTicket=RequestedTicket::all()->where('requester_id' , '=' , $requester_id)
                                                   ->where('is_accepted','=',0)->first();
            event(new StatusTicketRequested( $requestedTicket,$is_accept));
            $allrequest->pivot->delete();
            return redirect('/tickets/requests');
        }
        public function ticketSold($id){
            //ticke will not be sold if its quntity =0  beacuse
            //one ticket can be requested by one more user with different quantity
            $ticket = Ticket::find($id);
            $user=User::find(Auth::user()->id);
            $requested =  RequestedTicket::where([['ticket_id' , '=' , $id] ,
            ['requester_id' , '=' , Auth::user()->id] ,
            ['user_id' , '=' , $ticket->user_id]])->first();
            $requested->is_sold=1;
            $requested->save();

            $ticket->quantity=$ticket->quantity-$requested->pivot->quantity;
            if($tiket->quantity==0){
                $ticket->is_sold =1;
            }
            $ticket->save();
             SoldTicket::create([
             'ticket_id' => $id,
             'user_id' => $ticket->user_id,
             'buyer_id' => Auth::user()->id,
             'quantity' => $requested->pivot->quantity ,
            ]);
            event(new TicketReceived($requested->id,1));
           return redirect('/tickets/requests');
         }


         public function cancelTicketSold($id){
            $ticket = Ticket::find($id);
            $ticket->is_sold =0;
            $ticket->save();
            $requested =  RequestedTicket::where([['ticket_id' , '=' , $id] ,
            ['requester_id' , '=' , Auth::user()->id] ,
            ['user_id' , '=' , $ticket->user_id]])->get();
            $requested[0]->is_sold = 0;
            $requested[0]->save();

            event(new TicketReceived($requested[0]->id,0));
            $requested[0]->delete();
           return redirect('/tickets/requests');
         }


}
