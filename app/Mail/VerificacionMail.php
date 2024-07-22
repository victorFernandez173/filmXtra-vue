<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificacionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Constructor
     *
     * @param $notifiable
     * @param $url
     */
    public function __construct(protected $notifiable, protected $url)
    {
    }

    /**
     * Datos básicos para el envío
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('filmxtra173@gmail.com', 'filmxtra'),
            to: $this->notifiable->email,
            subject: 'Verificación de email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verificacion',
            with: [
                'url'     => $this->url,
                'usuario' => $this->notifiable,
                'logo'    => public_path('images/logo.png'),
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
