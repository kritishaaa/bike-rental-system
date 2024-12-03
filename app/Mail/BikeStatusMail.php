<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BikeStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $bikeName;
    public $toDate;

    /**
     * Create a new message instance.
     *
     * @param string $userName
     * @param string $bikeName
     * @param string $toDate
     */
    public function __construct($userName, $bikeName, $toDate)
    {
        $this->userName = $userName;
        $this->bikeName = $bikeName;
        $this->toDate = $toDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bike Rental Confirmation'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.bike-status', // Use a Blade template for the email content
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
