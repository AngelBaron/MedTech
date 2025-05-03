<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionMedico extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $password;
    public $dias;
    public $horario_inicio;
    public $horario_fin;


    /**
     * Create a new message instance.
     */
    public function __construct($nombre, $password,$dias,$horario_inicio,$horario_fin)
    {
        $this->nombre = $nombre;
        $this->password = $password;
        $this->dias = $dias;
        $this->horario_inicio = $horario_inicio;
        $this->horario_fin = $horario_fin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificacion Medico',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.medico.Registro_Medico',
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
