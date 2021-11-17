@component('mail::message')

#  {{ $details['user'] }} has modified an entry from {{ $details['model'] }}

# Title: {{ $details['title'] }}

Details : {{ $details['body'] }}

Time: {{ $details['time'] }}

## Review the Changes by clicking this button
{{--
@component('mail::button', ['url' => $details['link']])
View in Dashboard
@endcomponent --}}

Thanks,<br>
Brave Media Workflow
@endcomponent
