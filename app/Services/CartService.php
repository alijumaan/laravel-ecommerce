<?php

namespace App\Services;

use App\Models\Product;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartService
{
    public function addToList(string $instance, object $product, int $quantity = 1): bool
    {
        $duplicated = Cart::instance($instance)->search(function ($cartItem, $rowId) use($product){
            return $cartItem->id === $product->id;
        });

        if ($duplicated->isNotEmpty()) {
            throw new Exception('Product already exist.');
        } else {
            Cart::instance($instance)->add($product->id, $product->name, $quantity, $product->price)->associate(Product::class);
            return true;
        }
    }
}
