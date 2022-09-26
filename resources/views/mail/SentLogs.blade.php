@component('mail::message')
    # {{ $details['title'] }}

    {{ $details['body'] }}


    @component('mail::button', ['url' => 'https://wf.newscentral.ng/logs/cot'])
        Check Logs
    @endcomponent

    Thanks,<br>
    NewsCentral TV
@endcomponent
