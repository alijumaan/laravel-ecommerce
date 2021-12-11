<?php

namespace App\Http\Livewire\Frontend\Header;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class WishlistComponent extends Component
{
    use LivewireAlert;

    public $wishlistCount;

    protected $listeners = [
        'update_wishlist' => 'wishlistCount',
        'remove_from_wishlist' => 'removeFromWishlist',
        'move_to_cart' => 'moveToCart'
    ];

    public function mount()
    {
        $this->wishlistCount();
    }

    public function wishlistCount()
    {
        $this->wishlistCount = Cart::instance('wishlist')->count();
        if (Cart::instance('wishlist')->count() == 0) {
            $this->emit('update_message_wishlist_not_found');
        }
    }

    public function moveToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);

        $duplicate = Cart::instance('default')->search(function ($cartItem, $rId) use ($rowId) {
            return $rId === $rowId;
        });

        if ($duplicate->isNotEmpty()) {
            $this->removeFromWishlist($rowId);
            $this->alert('warning', 'Product already exist.');
        } else {
            Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
                ->associate(Product::class);
            $this->removeFromWishlist($rowId);
            $this->alert('success', 'Added to Cart.');
        }
        $this->emit('update_cart');
    }

    public function removeFromWishlist($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        $this->emit('update_wishlist');
    }

    public function render()
    {
        return view('livewire.frontend.header.wishlist-component');
    }
}
