@component('mail::message')
# {{ $details['title'] }}

{{ $details['body'] }}


@component('mail::button', ['url' => 'https://nbd.bravetech.media/logs/cot'])
Check Logs
@endcomponent

Thanks,<br>
NewsCentral TV
@endcomponent
