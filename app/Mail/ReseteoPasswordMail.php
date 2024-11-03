<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReseteoPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected $notifiable, public string $url) {}

    /**
     * Datos básicos para el envío
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('filmxtra173@gmail.com', 'filmxtra'),
            to: $this->notifiable->email,
            subject: 'Restablecimiento de contraseña',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.restablecimientoPassword',
            with: [
                'usuario' => $this->notifiable,
                'url' => $this->url.'/'.$this->notifiable->id,
                'logo' => public_path('images/logo.png'),
            ]
        );
    }
}
