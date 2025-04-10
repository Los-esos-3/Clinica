<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
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

    /**
     * Build the message.
     */
    public function build()
    {
        logger()->info('Building email with verification code: ' . $this->verificationCode);
        
        return $this->subject('Tu Código de Verificación')
                    ->view('emails.verification_code')
                    ->with([
                        'verificationCode' => $this->verificationCode
                    ]);
    }
} 