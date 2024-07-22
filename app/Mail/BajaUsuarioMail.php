<?php

namespace App\Mail;

use App\Models\LoginTipo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BajaUsuarioMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected $notifiable
    ){}

    /**
     * Datos básicos para el envío
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('filmxtra173@gmail.com', 'filmxtra'),
            to: $this->notifiable->email,
            subject: 'Baja en filmxtra',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.bajaUsuario',
            with: [
                'usuario' => $this->notifiable,
                'logo'    => public_path('images/logo.png'),
                'loginTipo' => LoginTipo::find($this->notifiable->login_tipo_id)
            ]
        );
    }
}
