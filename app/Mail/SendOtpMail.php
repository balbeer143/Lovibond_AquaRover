<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $isResend;
    public $isForgotPassword;
    /**
     * Create a new message instance.
     */
    public function __construct($otp, $isResend = false, $isForgotPassword = false)
    {
        $this->otp = $otp;
        $this->isResend = $isResend;
        $this->isForgotPassword = $isForgotPassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        if ($this->isForgotPassword) {
            $subject = 'Password Reset OTP - AquaRover';
        } elseif ($this->isResend) {
            $subject = 'Your Resent OTP Code - AquaRover';
        } else {
            $subject = 'Your OTP Code - AquaRover';
        }

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.send-otp',
            with: [
                'otp' => $this->otp,
                'isResend' => $this->isResend,
                'isForgotPassword' => $this->isForgotPassword,
            ],
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
