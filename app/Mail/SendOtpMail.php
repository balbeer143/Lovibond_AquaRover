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
    /**
     * Create a new message instance.
     */
    public function __construct($otp, $isResend = false)
    {
        $this->otp = $otp;
        $this->isResend = $isResend;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        $subject = $this->isResend 
            ? 'Your Resent OTP Code - AquaRover'
            : 'Your OTP Code - AquaRover';

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
