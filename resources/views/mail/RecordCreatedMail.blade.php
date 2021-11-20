@component('mail::message')

#  {{ $details['user'] }} has posted to {{ $details['model'] }}!

# Title: {{ $details['title'] }}

Details : {{ $details['body'] }}

Time: {{ $details['time'] }}

{{-- ## Review the Ticket by clicking this button --}}
{{--
@component('mail::button', ['url' => $details['link']])
View in Dashboard
@endcomponent --}}

Thanks,<br>
Brave Media Workflow
@endcomponent
