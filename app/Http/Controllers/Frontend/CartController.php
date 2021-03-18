<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Repositories\Frontend\CartRepository;

class CartController extends Controller
{
    public $cartRepository;
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = \Cart::session(auth()->id())->getContent();
        return view('frontend.cart.index', compact('cartItems'));
    }

    public function add(Product $product)
    {
        $this->cartRepository->aadToCart($product);

        return back()->with('msg', 'Items has been add to cart');
    }

    public function destroy($id)
    {
        \Cart::session(auth()->id())->remove($id);

        return back()->with('msg', 'Item has been removed');
    }

    public function applyCoupon()
    {
        $couponCode = request('coupon_code');

        $couponData = Coupon::where('code', $couponCode)->first();

        if(!$couponData) {

            return back()->with(['message' => 'Sorry! Coupon does not exist', 'alert-type' => 'danger']);
        }

        // Coupon logic
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => $couponData->name,
            'type' => $couponData->type,
            'target' => 'total',
            'value' => $couponData->value,
        ));

        \Cart::session(auth()->id())->condition($condition); // for a speicifc user's cart

        return back()->with(['message' => 'coupon applied', 'alert-type' => 'success']);
    }
}
