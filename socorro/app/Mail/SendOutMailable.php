<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOutMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $sendout;

    public function __construct($sendout)
    {
        $this->sendout = $sendout;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de Salida',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'module.emails.sendout',
            with: [
                'sendout' => $this->sendout,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
