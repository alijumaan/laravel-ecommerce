@component('mail::message')
# New Order

You received new order.

@component('mail::button', ['url' => 'http://cart.test/dashboard'])
Show order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
