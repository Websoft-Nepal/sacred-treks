<?php

namespace App\Mail;

use App\Models\TrekkingBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrekkingBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $trekkingBooking;
    /**
     * Create a new message instance.
     */
    public function __construct(TrekkingBooking $trekkingBooking)
    {
        $this->trekkingBooking = $trekkingBooking;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You have successfully book your trekking',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.trekkings',
            with:[
                'trekkingBooking' => $this->trekkingBooking,
            ]
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
