@component('mail::message')
# {{ $details['title'] }}

{{ $details['body'] }}


@component('mail::button', ['url' => 'https://brave-new.herokuapp.com/logs/cot'])
Check Logs
@endcomponent

Thanks,<br>
Brave Media Workflow
@endcomponent
