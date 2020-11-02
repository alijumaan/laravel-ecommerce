@component('mail::message')
# Order Completed

Thank you for your order. Please order again.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/dashboard'])
My orders
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
