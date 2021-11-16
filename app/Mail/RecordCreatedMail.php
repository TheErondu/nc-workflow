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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return $this->from($from)
        ->subject('Record Created Email')
        ->cc('nbdengineers@ke.nationmedia.com')
        ->markdown('mail.RecordCreatedMail', compact('name'));
    }
}
