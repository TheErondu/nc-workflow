<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\UserLoggedInEmail;

class UserLoggedInListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
     public function handle($event)
<<<<<<< HEAD
     {  
	 $email = Auth::User()->email;
        Mail::to($email)->send(new UserLoggedInEmail());
=======

     {  $email = $event->details['email'];
        Mail::to($email)->send(new UserLoggedInEmail($event->details));
>>>>>>> f927862db155fc0c65f006a27c3e4906b6bb4c77
     }
}
