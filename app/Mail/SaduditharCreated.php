<?php

namespace App\Mail;

use App\Models\Sadudithar;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SaduditharCreated extends Mailable
{
    use Queueable, SerializesModels;

      public $sadudithar;

    /**
     * Create a new message instance.
     */
    public function __construct(Sadudithar $sadudithar)
    {
           $this->sadudithar = $sadudithar;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sadudithar Created',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
        view: 'emails.sadudithar_created',
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
