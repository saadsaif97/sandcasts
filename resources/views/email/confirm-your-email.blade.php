@component('mail::message')
# One more step to join Sandcasts!

Please confirm your email.

@component('mail::button', ['url' => route('confirm-email').'?token='.$user->confirm_token])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
