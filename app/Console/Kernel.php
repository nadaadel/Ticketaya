<?php

namespace App\Console;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Ticket;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\CheckDateTicket',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Here Run Command to check expire date for tickets

        // $schedule->job(CheckDateTicket::class)->everyMinute();
        $schedule->command('check:date-ticket')->everyMinute();

        // $schedule->call(function(){
        //     $tickets = Ticket::where('expire_date' ,'<=', Carbon::now()->toDateTimeString())->get();
        //     foreach($tickets as $ticket){
        //             $ticket->delete();
        //     }
        // })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
