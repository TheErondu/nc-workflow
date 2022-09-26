<?php

namespace App\Mail;
use App\Models\User;
use App\Utils\Globals;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UserLoggedInEmail extends Mailable
implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()

    {
        $from = env('MAIL_FROM_ADDRESS');
        $engineer_mails = Globals::mailingGroups("Engineers");
        return $this->from($from)
        ->subject('Login Notification Email')
        ->cc($engineer_mails)
        ->markdown('mail.UserLoggedInMail');
    }
}
