<?php

namespace App\Http\Livewire\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistItemComponent extends Component
{
    public function moveToCart($rowId)
    {
        $this->emit('move_to_cart', $rowId);
        $this->alert('success', 'Item move to cart.');
    }

    public function removeFromWishlist($rowId)
    {
        $this->emit('remove_from_wishlist', $rowId);
        $this->alert('success', 'Item removed from wishlist!');
    }

    public function render()
    {
        return view('livewire.frontend.wishlist-item-component', [
            'wishlistItems' => Cart::instance('wishlist')->content()
        ]);
    }
}
