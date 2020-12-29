<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Exceptions\InvalidConditionException;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = \Cart::session(auth()->id())->getContent();

        return view('frontend.cart.index', compact('cartItems'));
    }

    public function add(Product $product)
    {

        try {
            $condition = new CartCondition(array(
                'name' => 'VAT 5%',
                'type' => 'tax',
                'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
//                'value' => '5%',
                'value' => '0%',
                'attributes' => array( // attributes field is optional
                    'description' => 'Value added tax'
                )
            ));

            \Cart::condition($condition);
            \Cart::session(auth()->id())->condition($condition);

        } catch (InvalidConditionException $e) {
        }



        \Cart::session(auth()->id())->add(array(
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

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

            return back()->with([
                'message' => 'Sorry! Coupon does not exist',
                'alert-type' => 'danger'
            ]);
        }


        //coupon logic
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => $couponData->name,
            'type' => $couponData->type,
            'target' => 'total',
            'value' => $couponData->value,
        ));

        \Cart::session(auth()->id())->condition($condition); // for a speicifc user's cart


        return back()->with([
            'message' => 'coupon applied',
            'alert-type' => 'success'
        ]);

    }

}
