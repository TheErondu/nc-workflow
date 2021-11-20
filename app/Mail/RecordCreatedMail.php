<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class RecordCreatedMail extends Mailable
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
        $name = Auth::user()->name;
        $from = env('MAIL_FROM_ADDRESS');
        $cc = $this->details['cc_emails'];
        return $this->from($from)
        ->subject('Record Created Email')
        ->cc($cc)
        ->markdown('mail.RecordCreatedMail', compact('name'));
    }
}
