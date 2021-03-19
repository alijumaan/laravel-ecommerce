<!-- ACCORDION START -->
<div class="coupon-accordion">
    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
    <div id="checkout_coupon" class="coupon-checkout-content">
        <div class="coupon-info">
            <form action="{{route('cart.coupon')}}" method='get'>
                <p class="checkout-coupon">
                    <label>
                        <input id="coupon_code" type="text" name="coupon_code" placeholder="Coupon code"/>
                    </label>
                    <input type="submit" name="apply_coupon" value="Apply Coupon"/>
                </p>
            </form>
        </div>
    </div>
</div>
<!-- ACCORDION END -->
