<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordNotification extends Mailable
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
        return $this->view('emails.reset_password_notification')
            ->with([
                'email' => $this->email,
                'code' => $this->code
            ]);
    }
}
