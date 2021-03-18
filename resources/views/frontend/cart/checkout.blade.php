@extends('frontend.layouts.app')

@section('content')
<div class="checkout-area pt-5 pb-5">
    <div class="container">
        <div id="success" style="display: none" class="col-md-8 text-center h3 p-4 bg-success text-light rounded">The purchase was completed successfully</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="coupon-accordion">

                        <!-- ACCORDION START -->
                        <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                        <div id="checkout_coupon" class="coupon-checkout-content">
                            <div class="coupon-info">

                                <form action="{{route('cart.coupon')}}" method='get'>
                                    <p class="checkout-coupon">
                                        <label>
                                            <input id="coupon_code" type="text" name="coupon_code" placeholder="Coupon code" />
                                        </label>
                                        <input type="submit" name="apply_coupon" value="Apply Coupon" />
                                    </p>
                                </form>

                            </div>
                        </div>
                        <!-- ACCORDION END -->
                    </div>
                </div>
            </div>

            {!! Form::open(['route' => 'checkout.store', 'method' => 'post']) !!}
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">

                    <div class="checkbox-form">
                        <h3>{{ __('Billing Details') }}</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    {!! Form::label('text', 'First name*') !!}
                                    {!! Form::text('shipping_first_name', old('shipping_first_name'), ['placeholder' => 'First name']) !!}
                                    @error('shipping_first_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    {!! Form::label('text', 'Last name*') !!}
                                    {!! Form::text('shipping_last_name', old('shipping_last_name'), ['placeholder' => 'Last name']) !!}
                                    @error('shipping_last_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    {!! Form::label('text', 'Address*') !!}
                                    {!! Form::text('shipping_address', old('shipping_address'), ['placeholder' => 'Address']) !!}
                                    @error('shipping_address')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    {!! Form::label('text', 'State*') !!}
                                    {!! Form::text('shipping_state', old('shipping_state'), ['placeholder' => 'State']) !!}
                                    @error('shipping_state')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    {!! Form::label('text', 'City*') !!}
                                    {!! Form::text('shipping_city', old('shipping_city'), ['placeholder' => 'City']) !!}
                                    @error('shipping_city')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    {!! Form::label('email', 'Email*') !!}
                                    {!! Form::email('shipping_email', old('email'), ['placeholder' => 'Email']) !!}
                                    @error('shipping_email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    {!! Form::label('text', 'Phone*') !!}
                                    {!! Form::text('shipping_phone', old('shipping_phone'), ['placeholder' => 'Phone']) !!}
                                    @error('shipping_phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list create-acc">
                                    {!! Form::label('payment_method', 'Cash', ['class' => 'form-check-input', 'for' => 'cash_on_delivery']) !!}
                                    {!! Form::radio('payment_method', 'cash_on_delivery', ['class' => 'form-check-input', 'id' => 'cash_on_delivery']) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list create-acc">
                                    {!! Form::label('payment_method', 'card', ['class' => 'form-check-input', 'for' => 'card']) !!}
                                    {!! Form::radio('payment_method', 'card', ['class' => 'form-check-input']) !!}
                                </div>
                            </div>
{{--                            <div class="col-md-12">--}}
{{--                                <div class="checkout-form-list create-acc">--}}
{{--                                    {!! Form::label('payment_method', 'PayPal', ['class' => 'form-check-input', 'for' => 'paypal']) !!}--}}
{{--                                    {!! Form::radio('payment_method', 'paypal', ['class' => 'form-check-input']) !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="col-md-12">
                                <div class="checkout-form-list create-acc">
                                    <input id="cbox" type="checkbox" />
                                    <label>Create an account?</label>
                                </div>
                                <div id="cbox_info" class="checkout-form-list create-account">
                                    <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                    <label>Account password  <span class="required">*</span></label>
                                    <input type="password" placeholder="password" />
                                </div>
                            </div>
                        </div>

                        <div class="different-address">
                            <div class="ship-different-title">
                                <h3>
                                    <label>Ship to a different address?</label>
                                    <input id="ship-box" type="checkbox" name="billing_order"/>
                                </h3>
                            </div>
                            <div id="ship-box-info" class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        {!! Form::label('text', 'First name*') !!}
                                        {!! Form::text('billing_first_name', old('billing_first_name'), ['placeholder' => 'First name']) !!}
                                        @error('billing_first_name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        {!! Form::label('text', 'Last name*') !!}
                                        {!! Form::text('billing_last_name', old('billing_last_name'), ['placeholder' => 'Last name']) !!}
                                        @error('billing_last_name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        {!! Form::label('text', 'State*') !!}
                                        {!! Form::text('billing_state', old('billing_state'), ['placeholder' => 'State']) !!}
                                        @error('billing_state')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        {!! Form::label('text', 'City*') !!}
                                        {!! Form::text('billing_city', old('billing_city'), ['placeholder' => 'City']) !!}
                                        @error('billing_city')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        {!! Form::label('text', 'Address*') !!}
                                        {!! Form::text('billing_address', old('billing_address'), ['placeholder' => 'Address']) !!}
                                        @error('billing_address')<span class="text-danger">{{ $message }}</span>@enderror
                                        <input type="text" placeholder="Apartment, suite, unit etc. (optional)" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        {!! Form::label('text', 'Phone*') !!}
                                        {!! Form::text('billing_phone', old('billing_phone'), ['placeholder' => 'Phone']) !!}
                                        @error('billing_phone')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="order-notes">
                                <div class="checkout-form-list mrg-nn">
                                    {!! Form::label('text', 'Order Notes') !!}
                                    {!! Form::textarea('shipping_notes', old('shipping_notes'), ['placeholder' => 'Notes about your order, e.g. special notes for delivery.', 'id' => 'checkout-mess']) !!}
                                    @error('shipping_notes')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-12">
                    <div class="your-order">
                        <h3 class="d-flex">Your order <span class="ml-auto">{{ auth()->user()->totalQuantity() }} item(s)</span></h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-total">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cartItems as $item)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{$item->name}} <strong class="product-quantity"> ×
                                                {{ $item->quantity }}
                                            </strong>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">${{Cart::session(auth()->id())->get($item->id)->getPriceSum()}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Cart Subtotal</th>
                                    <td><span class="amount">${{ auth()->user()->orderSubTotal() }}</span></td>
                                </tr>
                                <tr class="cart-subtotal">
                                    <th>Task(5%)</th>
                                    <td><span class="amount">${{ auth()->user()->tax() }}</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Order Quantity</th>
                                    <td><strong><span class="amount">${{ auth()->user()->orderTotal() }}</span></strong></td>
                                </tr>

                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div class="panel-group" id="faq">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true" data-parent="#faq" href="#payment-1">Direct Bank Transfer.</a></h5>
                                        </div>
                                        <div id="payment-1" class="panel-collapse collapse show">
                                            <div class="panel-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-2">Cheque Payment</a></h5>
                                        </div>
                                        <div id="payment-2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-3">PayPal</a></h5>
                                        </div>
                                        <div id="payment-3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-button-payment">

                                    <input type="submit" value="Place order" />
{{--                                    <div id="paypal-button" ></div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
    <!-- checkout-area end -->
@endsection

@section('script')
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
            env: 'sandbox', // Or 'production'
            style: {
                size: 'large',
                color: 'blue',
                shape: 'pill',
            },
            // Set up the payment:
            // 1. Add a payment callback
            payment: function(data, actions) {
                // 2. Make a request to your server
                return actions.request.post('/api/create-payment', {
                    userId: "{{ auth()->user()->id }}"
                })
                    .then(function(res) {
                        // 3. Return res.id from the response
                        return res.id;
                    });
            },
            // Execute the payment:
            // 1. Add an onAuthorize callback
            onAuthorize: function(data, actions) {
                // 2. Make a request to your server
                return actions.request.post('/api/execute-payment', {
                    paymentID: data.paymentID,
                    payerID:   data.payerID,
                    userId: "{{ auth()->user()->id }}"
                })
                    .then(function(res) {
                        $('#success').slideDown(200);
                        $('.card-body').slideUp(0);
                    });
            }
        }, '#paypal-button');
    </script>
@endsection


