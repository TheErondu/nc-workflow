@component('mail::message')
# Welcome back! {{ $details['user'] }},

You logged in to Brave on {{ \Carbon\Carbon::now()->format('d-M-Y, H:i a')}}

## Not You?
Contact IT Department Immediately

@component('mail::button', ['url' => 'https://nbd.bravetech.media/home'])
My Dashboard
@endcomponent

Thanks,<br>
Brave Media Workflow
@endcomponent
