@component('mail::message')

# {{ $details['fixed_by_name'] }} has changed the status of the Ticket raised for the {{ $details['item_name'] }} to "{{ $details['status'] }}" .

Resolution date : {{ $details['resolved_date'] }}

Engineers Comment:

"{{ $details['engineers_comment'] }}"

## Review the Ticket by clicking this button

@component('mail::button', ['url' => $details['link']])
View Ticket Details
@endcomponent

Thanks,<br>
NewsCentral TV
@endcomponent
