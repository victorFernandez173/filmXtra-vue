<?php

namespace App\Mail;

use App\Models\LoginTipo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;

class SocialiteLoginMail extends Mailable
{
    use Queueable, SerializesModels;
    public Usuario $usuario;
    public LoginTipo $loginTipo;
    /**
     * Create a new message instance.
     */
    public function __construct($usuario)
    {
        $this->usuario = $usuario;
        $this->loginTipo = LoginTipo::where('id', $usuario->login_tipo_id)->first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Login en filmXtra con ' . $this->loginTipo->nombre);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.socialiteLogin',
            with: [
                'logo'    => public_path('images/logo.png'),
            ]
        );
    }
}
