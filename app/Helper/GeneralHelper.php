<?php

use Illuminate\Support\Facades\Cache;
use Spatie\Valuestore\Valuestore;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;

function get_gravatar($email, int $s = 80, string $d = 'mp', string $r = 'g', bool $img = false, array $atts = array()): string
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=${s}&d=${d}&r=${r}";

    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }

    return $url;
}

function clear_cache(): void
{
    Cache::forget('shop_categories_menu');
    Cache::forget('shop_tags_menu');
    Cache::forget('recent_reviews');
}

function getSettingsOf(string $key)
{
    $settings = Valuestore::make(config_path('settings.json'));
    return $settings->get($key);
}

function getNumbersOfCart(): Collection
{
    $subtotal = Cart::instance('default')->subtotal();
    $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0.00;
    $discountCode = session()->has('coupon') ? session()->get('coupon')['code'] : null;

    $subtotalAfterDiscount = $subtotal - $discount;

    $tax = config('cart.tax') / 100;
    $taxText = config('cart.tax') . '%';

    $productTaxes = round($subtotalAfterDiscount * $tax, 2);
    $newSubTotal = $subtotalAfterDiscount + $productTaxes;

    $shipping = session()->has('shipping') ? session()->get('shipping')['cost'] : 0.00;
    $shippingCode = session()->has('shipping') ? session()->get('shipping')['code'] : null;

    $total = ($newSubTotal + $shipping) > 0 ? round($newSubTotal + $shipping, 2) : 0.00;

    return collect([
        'subtotal' => $subtotal,
        'tax' => $tax,
        'taxText' => $taxText,
        'productTaxes' => (float) $productTaxes,
        'newSubTotal' => (float) $newSubTotal,
        'discount' => (float) $discount,
        'discountCode' => $discountCode,
        'shipping' => (float) $shipping,
        'shippingCode' => $shippingCode,
        'total' => (float) $total,
    ]);
}
