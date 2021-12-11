<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Coupon;
use App\Models\PaymentMethod;
use App\Models\ShippingCompany;
use App\Models\UserAddress;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CheckoutComponent extends Component
{
    use LivewireAlert;
    
    public $cartSubTotal;
    public $cartTax;
    public $cartTotal;
    public $cartCoupon;
    public $couponCode;
    public $cartShipping;
    public $cartDiscount;
    public $addresses;
    public $userAddressId = 0;
    public $shippingCompanies;
    public $shippingCompanyId = 0;
    public $paymentMethods;
    public $paymentMethodId = 0;
    public $paymentMethodCode;


    protected $listeners = [
        'update_cart' => 'mount'
    ];

    public function mount()
    {
        $this->addresses = auth()->user()->addresses;
        $this->userAddressId = session()->has('saved_user_address_id') ? session()->get('saved_user_address_id') : '';
        $this->shippingCompanyId = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        $this->paymentMethodId = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';
        $this->cartSubTotal = getNumbersOfCart()->get('subtotal');
        $this->cartTax = getNumbersOfCart()->get('productTaxes');
        $this->cartDiscount = getNumbersOfCart()->get('discount');
        $this->cartShipping = getNumbersOfCart()->get('shipping');
        $this->cartTotal = getNumbersOfCart()->get('total');
        if ($this->userAddressId == '') {
            $this->shippingCompanies = collect([]);
        } else {
            $this->getShippingCompanies();
        }
        $this->paymentMethods = PaymentMethod::whereStatus(true)->get();
    }

    public function applyDiscount()
    {
        if (getNumbersOfCart()) {
            $coupon = Coupon::whereCode($this->couponCode)->whereStatus(true)->first();
            if (!$coupon) {
                $this->couponCode = '';
                return $this->alert('error', 'Coupon is invalid');
            }

            if ($coupon->greater_than > getNumbersOfCart()->get('subtotal')) {
                $this->couponCode = '';
                return $this->alert('warning', 'Subtotal must greater than $'. $coupon->greater_than);
            }

            $couponValue = $coupon->discount($this->cartSubTotal);
            if ($couponValue < 0) {
                return $this->alert('error', 'product coupon is invalid');
            }

            session()->put('coupon', [
                'code' => $coupon->code,
                'value' => $coupon->value,
                'discount' => $couponValue
            ]);

            $this->couponCode = session()->get('coupon')['code'];
            $this->emit('update_cart');
            return $this->alert('success', 'Coupon is applied successfully');
        }

        $this->couponCode = '';
        return $this->alert('error', 'No products available in your cart');
    }

    public function removeCoupon()
    {
        session()->remove('coupon');
        $this->couponCode = '';
        $this->emit('update_cart');
        $this->alert('success', 'remove coupon successfully');
    }

    public function getShippingCompanies()
    {
        $addressCountry = UserAddress::whereId($this->userAddressId)->first();

        $this->shippingCompanies = ShippingCompany::whereHas('countries', function ($query) use ($addressCountry) {
            $query->where('country_id', $addressCountry->country_id);
        })->get();
    }

    // Lifecycle Hooks updating (UserAddressId)
    public function updatingUserAddressId()
    {
        session()->forget('saved_user_address_id');
        session()->forget('saved_shipping_company_id');
        session()->forget('shipping');
        session()->put('saved_user_address_id', $this->userAddressId);
        $this->userAddressId = session()->has('saved_user_address_id') ? session()->get('saved_user_address_id') : '';
        $this->shippingCompanyId = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        $this->paymentMethodId = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';
        $this->emit('update_cart');
    }

    // Lifecycle Hooks updated (UserAddressId)
    public function updatedUserAddressId()
    {
        session()->forget('saved_user_address_id');
        session()->forget('saved_shipping_company_id');
        session()->forget('shipping');
        session()->put('saved_user_address_id', $this->userAddressId);

        $this->userAddressId = session()->has('saved_user_address_id') ? session()->get('saved_user_address_id') : '';
        $this->shippingCompanyId = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        $this->paymentMethodId = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';
        $this->emit('update_cart');
    }

    public function storeShippingCost()
    {
        $shippingCompany = ShippingCompany::whereId($this->shippingCompanyId)->first();

        session()->put('shipping', [
            'code' => $shippingCompany->code,
            'cost' => $shippingCompany->cost
        ]);

        $this->emit('update_cart');
        $this->alert('success', 'Shipping cost is applied successfully');
    }

    // Lifecycle Hooks updating (ShippingCompanyId)
    public function updatingShippingCompanyId()
    {
        session()->forget('saved_shipping_company_id');
        session()->put('saved_shipping_company_id', $this->shippingCompanyId);
        $this->userAddressId = session()->has('saved_user_address_id') ? session()->get('saved_user_address_id') : '';
        $this->shippingCompanyId = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        $this->emit('update_cart');
    }

    // Lifecycle Hooks updated (ShippingCompanyId)
    public function updatedShippingCompanyId()
    {
        session()->forget('saved_shipping_company_id');
        session()->put('saved_shipping_company_id', $this->shippingCompanyId);
        $this->userAddressId = session()->has('saved_user_address_id') ? session()->get('saved_user_address_id') : '';
        $this->shippingCompanyId = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        $this->emit('update_cart');
    }

    public function getPaymentMethod()
    {
        $paymentMethod = PaymentMethod::whereId($this->paymentMethodId)->first();
        $this->paymentMethodCode = $paymentMethod->code;
    }

    public function render()
    {
        return view('livewire.frontend.checkout.checkout-component');
    }
}
