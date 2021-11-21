<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class EngineerAssignedMail extends Mailable
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
        $engineer = $this->details['copy'];
        return $this->from($from)
        ->subject('Issue  Notification Email')
        ->cc($engineer)
        ->markdown('mail.EngineerAssignedMail');
    }
}
