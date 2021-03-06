<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Ticket;
use App\RequestedTicket;
use App\SoldTicket;
use Carbon\Carbon;
class CheckDateTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:date-ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command To Check tickets if expiredate is today delete it at midnight';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tickets = Ticket::where('expire_date' ,'<=', Carbon::now()->toDateTimeString())->get();
        foreach($tickets as $ticket){
         $ticketRequests = RequestedTicket::where('ticket_id', '=' , $ticket->id)->get();
         if(ticketRequests !== null){
            foreach($ticketRequests as $ticket){
            $ticket->delete();
               }
        }
        $ticketSolds = SoldTicket::where('ticket_id', '=' , $ticket->id)->get();
        if($ticketSolds !== null){
        foreach($ticketSolds as $ticket){
            $ticket->delete();
         }
       }
                $ticket->delete();
        }
    }
}
