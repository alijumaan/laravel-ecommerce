<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class WishlistItemComponent extends Component
{
    use LivewireAlert;
    public string $item;

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
        return view('livewire.frontend.wishlist.wishlist-item-component', [
            'wishlistItem' => Cart::instance('wishlist')->content()->get($this->item)
        ]);
    }
}
