@component('mail::message')
# Order Completed

Thank you for your order. Please order again.

@component('mail::button', ['url' => 'http://cart.test'])
My orders
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
