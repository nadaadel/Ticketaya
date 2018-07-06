<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwilioController extends Controller
{
    use Twilio;

    public function sendVerifications(){

        Twilio::message('01276170952' , 'Hello Nada From Ticketaya');
    }
}
