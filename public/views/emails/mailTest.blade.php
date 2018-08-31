@component('mail::message')
# Introduction
Your welcome,
It's an email test
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
