<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Coupon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CartTotalComponent extends Component
{
    use LivewireAlert;

    public $cartSubTotal;
    public $cartTotal;
    public $cartTax;
    public $cartDiscount;
    public $cartShipping;
    public $couponCode;

    protected $listeners = [
        'update_cart' => 'mount'
    ];

    public function mount()
    {
        $this->cartSubTotal = getNumbersOfCart()->get('subtotal');
        $this->cartTotal = getNumbersOfCart()->get('total');
        $this->cartTax = getNumbersOfCart()->get('productTaxes');
        $this->cartDiscount = getNumbersOfCart()->get('discount');
        $this->cartShipping = getNumbersOfCart()->get('shipping');
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

    public function render()
    {
        return view('livewire.frontend.cart.cart-total-component');
    }
}
