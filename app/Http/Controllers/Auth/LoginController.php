<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Events\UserLoggedIn;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectTo()
    {
        $user = auth()->user();
        $details = [
            'email' => $user->email,
            'name' => $user->name,
            'status' =>  $user->dts_in,
            'body' =>  $user->comment,
            'model' =>  'User',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y'),
            // 'cc_emails' => $cc_emails
        ];

        Event::dispatch(new UserLoggedIn($details));
    }
}
