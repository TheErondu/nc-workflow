
@component('mail::message')
# Your Password has been Reset!

## Your new Password is : {{$newpassword}}

You can now login to your dashboard using this password.

@component('mail::button', ['url' => 'https://brave-new.herokuapp.com/login'])
Login to your Account
@endcomponent

Thanks,<br>
Brave Media Workflow
@endcomponent
