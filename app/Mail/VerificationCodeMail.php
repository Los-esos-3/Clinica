<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationCode;

    /**
     * Create a new message instance.
     */
    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
        logger()->info('Constructor VerificationCodeMail - Code: ' . $verificationCode);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Código de Verificación - Clinica',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verification-code',
            with: [
                'verificationCode' => $this->verificationCode,
            ],
        );
    }
} 