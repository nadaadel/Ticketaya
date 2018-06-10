<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SpamNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $userofTicket;
    protected $name;
    protected $message;
    protected $user;
    public function __construct($ticket,$message,$user)
    {
        $this->userofTicket=$ticket->user->name;
        $this->name=$ticket->name;
        $this->message=$message;
        //dd($message);

        $this->user=$user->name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->user.' report ticket '.$this->name.' belong to '.$this->userofTicket.' and let message :'.$this->message )
                    ->action('Notification Action', url('/users'))
                    ->line('Thank you !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
