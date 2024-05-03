<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendFc007Email extends Mailable
{
    use Queueable, SerializesModels;
    public $referenceNumber;
    public $process;
    public $name;

    /**
     * Create a new message instance.
     */
    public function __construct($referenceNumber,$process,$name)
    {
        $this->referenceNumber = $referenceNumber;
        $this->process = $process;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->process.' for F-FC-007 report Reference # '.$this->referenceNumber,
            from: env('MAIL_FROM_ADDRESS'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.send-fc-007-email',
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
