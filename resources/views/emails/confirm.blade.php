@component('mail::message')
# Hello {{ $user->name }}

You have updated your email , Please click the below link to verify

@component('mail::button', ['url' => route('verify',$user->verification_token)])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent