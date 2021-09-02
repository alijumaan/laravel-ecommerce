<div class="col-md-5 ml-auto">
    <div class="cart-page-total pt-0">
        @if($cartTotal != 0)
        <h2>Cart totals</h2>
        <ul>
            <li>Subtotal<span>${{ $cartSubTotal }}</span></li>
            @if(session()->has('coupon'))
                <li>
                    Discount
                    <small>({{ getNumbersOfCart()->get('discountCode') }})</small>
                    <span>${{ $cartDiscount }}</span>
                </li>
            @endif
            @if(session()->has('shipping'))
                <li>
                    Shipping
                    <small>({{ getNumbersOfCart()->get('shippingCode') }})</small>
                    <span>${{ $cartShipping }}</span>
                </li>
            @endif
            <li>Tax(5%)<span>${{ $cartTax }}</span></li>
            <li>Total<span>${{ $cartTotal }}</span></li>
        </ul>
        <div class="coupon-all">
            <div class="coupon">
                @if(!session()->has('coupon'))
                    <form wire:submit.prevent="applyDiscount()">
                        <input wire:model="couponCode"class="input-text"
                               placeholder="Coupon code" type="text" required>
                            <input class="button" value="Apply coupon" type="submit">

                    </form>
                @endif
                @if(session()->has('coupon'))
                    <input wire:click.prevent="removeCoupon()" class="button"
                           value="Remove coupon" type="button">
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
