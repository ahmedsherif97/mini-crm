<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailChangeNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $newEmail;

    public function __construct($user, $newEmail)
    {
        $this->user = $user;
        $this->newEmail = $newEmail;
    }

    public function build()
    {
        return $this->view('emails.email_change_notification')
            ->with([
                'user' => $this->user,
                'newEmail' => $this->newEmail,
            ]);
    }
}
