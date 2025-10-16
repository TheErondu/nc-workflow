
@component('mail::message')

# Welcome back {{ $details['user'] }}!

You logged in to NC-WORKFLOW on:{{ \Carbon\Carbon::now()->format('d-M-Y, H:i a') }}

Not You?
  Contact IT Department Immediately
  @component('mail::button', ['url' => 'https://wf.newscentral.ng/home'])
  My Dashboard
@endcomponent

Thanks,<br>
NewsCentral TV
@endcomponent
