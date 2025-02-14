<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $code;

    public function __construct($email, $code)
    {
        $this->email = $email;
        $this->code = $code;
    }

    public function build()
    {
        return $this->view('emails.verify_email_notification')
            ->with([
                'email' => $this->email,
                'code' => $this->code
            ]);
    }
}
