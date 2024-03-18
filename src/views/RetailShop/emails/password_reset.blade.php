@component('mail::message')
# Password Reset

Click the button below to reset your password:

@component('mail::button', ['url' => route('RetailShop.password_reset', ['token' => $token])])
Reset Password
@endcomponent

If you did not request a password reset, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
