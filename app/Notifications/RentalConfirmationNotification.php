<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentalConfirmationNotification extends Notification
{
    use Queueable;

    protected $userName;
    protected $toDate;

    public function __construct($userName, $toDate)
    {
        $this->userName = $userName;
        $this->toDate = $toDate;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->subject('Rental Confirmation')
            ->greeting("Hello {$this->userName},")
            ->line('Your rental has been successfully confirmed!')
            ->line("Please ensure to return the bike by {$this->toDate}.")
            ->line('If the bike is not returned by this date, additional charges will be applied.')
            ->line('Thank you for choosing our service! We hope you enjoy your ride!')
            ->salutation('Warm regards, The RideFlex Team');
    }
}
