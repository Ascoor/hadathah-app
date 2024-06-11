<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;

    /**
     * Create a new message instance.
     *
     * @param string $resetUrl
     * @return void
     */
    public function __construct($resetUrl)
    {
        $this->resetUrl = $resetUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('إعادة تعيين كلمة المرور')
                    ->view('emails.reset_password')
                    ->with(['resetUrl' => $this->resetUrl]);
    }
}