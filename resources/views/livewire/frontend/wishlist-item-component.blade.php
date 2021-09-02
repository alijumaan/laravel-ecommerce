<div class="cart-main-area pt-50 pb-50 wishlist">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="cart-heading">wishlist</h1>
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th></th>
                                <th>Move To Cart</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($wishlistItems as $item)
                                <tr x-data="{ show: true }" x-show="show">
                                    <td class="product-thumbnail">
                                        @if($item->model->firstMedia)
                                            <a href="#">
                                                <img src="{{ asset('storage/assets/images/products/' . $item->model->firstMedia->file_name) }}"
                                                     alt="">
                                            </a>
                                        @else
                                            <img src="{{ asset('frontend/images/default_small.png') }}"
                                                 alt="{{ $item->model->name }}" width="70"/>
                                        @endif
                                    </td>
                                    <td class="product-name"><a href="#">{{ $item->model->name }}</a></td>
                                    <td class="product-name">
                                        <a wire:click="moveToCart('{{ $item->rowId }}')"
                                           x-on:click="show = false"
                                           style="cursor: pointer;">
                                            move to cart
                                        </a>
                                    </td>
                                    <td class="product-price-cart">
                                        <span class="amount">${{ $item->model->price }}</span>
                                    </td>
                                    <td>
                                        <a wire:click.prevent="removeFromWishlist('{{ $item->rowId }}')"
                                           x-on:click="show = false"
                                           style="cursor: pointer;">
                                            <i class="fas fa-trash-alt text-muted"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="pl-0 border-light" colspan="5">
                                        <p class="text-center">No items in your wish list.</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
