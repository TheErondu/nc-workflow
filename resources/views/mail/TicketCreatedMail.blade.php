@component('mail::message')

# {{ $details['raised_by'] }}has raised a ticket for {{ $details['item_name'] }} with description:

"{{ $details['description'] }}" .


## Review the Ticket by clicking this button

@component('mail::button', ['url' => $details['link']])
View Ticket Details
@endcomponent

Thanks,<br>
Brave Media Workflow
@endcomponent
