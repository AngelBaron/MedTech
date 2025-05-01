<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionMedico_Admin extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $cedula;
    public $especialidad;
    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($nombre, $cedula, $especialidad, $email)
    {
        $this->nombre = $nombre;
        $this->cedula = $cedula;
        $this->especialidad = $especialidad;
        $this->email = $email;
    }
    
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificacion Medico Admin',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.admin.Registro_Medico',
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
