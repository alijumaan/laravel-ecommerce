<?php

namespace App\Repositories\Frontend;

use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Exceptions\InvalidConditionException;

class CartRepository
{

    public function aadToCart($product)
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

    }

}
