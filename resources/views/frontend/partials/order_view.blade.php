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
                        <h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true" data-parent="#faq"
                                                   href="#payment-1">Direct Bank Transfer.</a></h5>
                    </div>
                    <div id="payment-1" class="panel-collapse collapse show">
                        <div class="panel-body">
                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment
                                reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false"
                                                   data-parent="#faq" href="#payment-2">Cheque Payment</a></h5>
                    </div>
                    <div id="payment-2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment
                                reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false"
                                                   data-parent="#faq" href="#payment-3">PayPal</a></h5>
                    </div>
                    <div id="payment-3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment
                                reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-button-payment">
                <input type="submit" value="Place order"/>
            </div>
        </div>
    </div>
</div>
