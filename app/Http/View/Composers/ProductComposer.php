<?php
namespace App\Http\View\Composers;

use App\Models\Product;
use Illuminate\View\View;

class ProductComposer
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function compose(View $view)
    {
        return $view->with('products', $this->product->orderBy('id', 'desc')->pluck('name', 'id'));
    }
}
