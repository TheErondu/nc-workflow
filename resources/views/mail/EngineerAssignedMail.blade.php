@component('mail::message')

# {{ $details['supervisor'] }} has assigned {{ $details['assigned_engineer'] }} to the ticket raised for Equipment / Item :

{{ $details['item_name'] }} with fault description:

"{{ $details['description'] }}"


## Department : {{ $details['department'] }}.

## Review the Ticket by clicking this button

@component('mail::button', ['url' => $details['link']])
View Ticket Details
@endcomponent

Thanks,<br>
NewsCentral TV
@endcomponent
