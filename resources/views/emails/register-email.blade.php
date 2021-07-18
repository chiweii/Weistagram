@component('mail::message')
Congrats ! You Register Weistagram Success

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
