<div>
    <div class="row">
        <div class="col-md-12 mb-3">
            @if(!session()->has('coupon'))
                <p>Have a coupon?</p>
                <form wire:submit.prevent="applyDiscount()">
                    <p class="checkout-coupon">
                        <input wire:model="couponCode" type="text" placeholder="Coupon code" required/>
                        <input type="submit" value="Apply Coupon" />
                    </p>
                </form>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-12">
            <h2 class="h5 text-uppercase mb-4">Shipping addresses</h2>
            <div class="row">
                @forelse($addresses as $address)
                    <div class="col-6 form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="address-{{ $address->id }}"
                                class="custom-control-input"
                                wire:model="userAddressId"
                                wire:click="getShippingCompanies()"
                                {{ intval($userAddressId) == $address->id ? 'checked' : '' }}
                                value="{{ $address->id }}">
                            <label for="address-{{ $address->id }}" class="custom-control-label text-small">
                                <b>{{ $address->address_title }}</b>
                                <small>
                                    {{ $address->address }}<br>
                                    {{ $address->country->name }} - {{ $address->state->name }}- {{ $address->city->name }}

                                </small>
                            </label>
                        </div>
                    </div>
                @empty
                    <div class="col-6 form-group">
                        <p class="text-danger">No addresses found</p>
                        <a class="btn btn-dark" href="#">Add Your Address</a>
                    </div>
                @endforelse
            </div>
            @if($userAddressId)
                <h2 class="h5 text-uppercase mb-4">Shipping way</h2>
                <div class="row">
                    @forelse($shippingCompanies as $shippingCompany)
                        <div class="col-6 form-group">
                            <div class="custom-control custom-radio">
                                <input
                                    type="radio"
                                    id="shipping-company-{{ $shippingCompany->id }}"
                                    class="custom-control-input"
                                    wire:model="shippingCompanyId"
                                    wire:click="storeShippingCost()"
                                    {{ intval($shippingCompanyId) == $shippingCompany->id ? 'checked' : '' }}
                                    value="{{ $shippingCompany->id }}">
                                <label for="shipping-company-{{ $shippingCompany->id }}"
                                       class="custom-control-label text-small">
                                    <b>{{ $shippingCompany->name }}</b>
                                    <small>
                                        {{ $shippingCompany->description }} (${{ $shippingCompany->cost }})
                                    </small>
                                </label>
                            </div>
                        </div>
                    @empty
                        <p>No shipping companies found</p>
                    @endforelse
                </div>
            @endif
            @if($userAddressId && $shippingCompanyId)
                <h2 class="h5 text-uppercase mb-4">Payment way</h2>
                <div class="row">
                    @forelse($paymentMethods as $paymentMethod)
                        <div class="col-6 form-group">
                            <div class="custom-control custom-radio">
                                <input
                                    type="radio"
                                    id="payment-method-{{ $paymentMethod->id }}"
                                    class="custom-control-input"
                                    wire:model="paymentMethodId"
                                    wire:click="getPaymentMethod()"
                                    {{ intval($paymentMethodId) == $paymentMethod->id ? 'checked' : '' }}
                                    value="{{ $paymentMethod->id }}">
                                <label for="payment-method-{{ $paymentMethod->id }}"
                                       class="custom-control-label text-small">
                                    <b>{{ $paymentMethod->name }}</b>
                                </label>
                            </div>
                        </div>
                    @empty
                        <p>No payment way found</p>
                    @endforelse
                </div>
            @endif

            @if($userAddressId && $shippingCompanyId && $paymentMethodId)
                @if(\Str::lower($paymentMethodCode) == 'ppex')
                    <form action="{{ route('payment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="userAddressId" value="{{ old('userAddressId', $userAddressId) }}"
                               class="form-control">
                        <input type="hidden" name="shippingCompanyId"
                               value="{{ old('shippingCompanyId', $shippingCompanyId) }}" class="form-control">
                        <input type="hidden" name="paymentMethodId" value="{{ old('paymentMethodId', $paymentMethodId) }}"
                               class="form-control">
                        <button type="submit" name="submit" class="btn btn-sm btn-primary btn-block uppercase">
                            PayPay Place order
                        </button>
                    </form>
                @endif
                    @if(\Str::lower($paymentMethodCode) == 'mada')
                        <form action="{{ route('checkout.charge_request') }}">
                            @csrf
                            <input type="hidden" name="userAddressId" value="{{ old('userAddressId', $userAddressId) }}"
                                   class="form-control">
                            <input type="hidden" name="shippingCompanyId"
                                   value="{{ old('shippingCompanyId', $shippingCompanyId) }}" class="form-control">
                            <input type="hidden" name="paymentMethodId" value="{{ old('paymentMethodId', $paymentMethodId) }}"
                                   class="form-control">
                            <button type="submit" name="submit" class="btn btn-sm btn-dark btn-block uppercase">
                                Mada Place order
                            </button>
                        </form>
                    @endif
            @endif
        </div>
        <div class="col-lg-6 col-md-12 col-12">
            <div class="your-order">
                <h4 class="mx-5">Your order</h4>
                <div class="your-order-table table-responsive">
                    <table>
                        <tbody>
                        <tr>
                            <th class="product-name">
                                <strong>Subtotal</strong>
                            </th>
                            <th class="product-total">${{ $cartSubTotal }}</th>
                        </tr>
                        @if(session()->has('coupon'))
                            <tr>
                                <th class="product-name">
                                    <strong>Discount</strong>
                                    <small>({{ getNumbersOfCart()->get('discountCode') }})</small><br>
                                    <a wire:click.prevent="removeCoupon()"
                                              class="btn btn-link btn-sm text-decoration-none text-danger">
                                            <small>Remove coupon</small>
                                        </a>
                                </th>
                                <th class="product-total">- ${{ $cartDiscount }}</th>
                            </tr>
                        @endif
                        @if(session()->has('shipping'))
                            <tr>
                                <th class="product-name">
                                    <strong>Shipping</strong>
                                    <small>({{ getNumbersOfCart()->get('shippingCode') }})</small>
                                </th>
                                <th class="product-total">${{ $cartShipping }}</th>
                            </tr>
                        @endif
                        <tr>
                            <th class="product-name">
                                <strong>Tax</strong>
                            </th>
                            <th class="product-total">${{ $cartTax }}</th>
                        </tr>
                        <tr class="order-total">
                            <th>
                                <strong>Total</strong>
                            </th>
                            <td>
                                <strong><span>${{ $cartTotal }}</span></strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>

</div>
