<div class="cart-main-area pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="cart-heading">Cart</h1>
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th>remove</th>
                                <th>images</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td class="product-remove"><a href="{{ route('cart.destroy', $item['id']) }}"><i
                                                class="fas fa-times"></i></a></td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img style="width: 50px;"
                                                         src="{{ asset('storage/images/default.png') }}" alt=""></a>
                                    </td>
                                    <td class="product-name"><a href="#">{{ $item['name'] }} </a></td>
                                    <td class="product-price-cart"><span class="amount">
                                                ${{ Cart::session(auth()->id())->get($item['id'])->getPriceSum() }}
                                            </span></td>
                                    <td class="product-quantity">
                                        <livewire:cart-update-form :item="$item" :key="$item['id']"/>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="coupon-all">
                            <div class="coupon">
                                <form action="{{route('cart.coupon')}}" method='get'>
                                    <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                           placeholder="Coupon code" type="text" required>
                                    <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 ml-auto">
                        <div class="cart-page-total">
                            @if($cartItems)
                                <h2>Cart totals</h2>
                                <ul>
                                    <li>Subtotal<span>${{ \Cart::session(auth()->id())->getSubTotal() }}</span></li>
                                    <li>Tax(5%)<span>${{ auth()->user()->tax() }}</span></li>
                                    <li>Total<span>${{ \Cart::session(auth()->id())->getTotal() }}</span></li>
                                </ul>
                                <a href="{{route('checkout.index')}}">Proceed to checkout</a>
                            @endif
                            <a href="{{route('frontend.products.index')}}">Continue to shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


