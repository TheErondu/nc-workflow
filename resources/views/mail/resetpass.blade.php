
@component('mail::message')
# Your Password has been Reset!

## Your new Password is : {{$newpassword}}

You can now login to your dashboard using this password.

@component('mail::button', ['url' => 'https://nbd.bravetech.media/login'])
Login to your Account
@endcomponent

Thanks,<br>
NewsCentral TV
@endcomponent
