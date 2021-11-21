@component('mail::message')
# {{ $details['title'] }}

{{ $details['body'] }}


@component('mail::button', ['url' => 'https://nbd.bravetech.media/logs/cot'])
Check Logs
@endcomponent

Thanks,<br>
Brave Media Workflow
@endcomponent
