<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BienvenidaMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected $notifiable) {}

    /**
     * Datos básicos para el envío
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('filmxtra173@gmail.com', 'filmxtra'),
            to: $this->notifiable->email,
            subject: 'Verificación exitosa',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.bienvenida',
            with: [
                'usuario' => $this->notifiable,
                'logo' => public_path('images/logo.png'),
            ]
        );
    }

    /**
     * Adjuntos
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
