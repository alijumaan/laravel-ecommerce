<div>
    <div class="shop-product-wrapper res-xl res-xl-btn">
        <div class="shop-bar-area">
            <div class="shop-bar pb-60">
                <div class="shop-found-selector">
                    <div class="shop-found">
                        <p class="small">
                            Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} results
                        </p>
                    </div>
                    <div wire:ignore class="shop-selector">
                        <label>Sort By :</label>
                        <select wire:model="sortingBy">
                            <option value="default">Default sorting</option>
                            <option value="popularity">Popularity</option>
                            <option value="low-high">Price: Low to High</option>
                            <option value="high-low">Price: High to Low</option>
                        </select>

                    </div>
                </div>
                <div class="shop-filter-tab">
                    <div class="shop-tab nav" role=tablist>
                        <a class="active" href="#grid-sidebar1" data-toggle="tab" role="tab" aria-selected="true">
                            <i class="fas fa-border-all"></i>
                        </a>
                        <a href="#grid-sidebar2" data-toggle="tab" role="tab" aria-selected="false">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="shop-product-content tab-content">
                <div id="grid-sidebar1" class="tab-pane fade active show">
                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-lg-4 col-xl-3 col-md-6">
                                <div class="product-fruit-wrapper mb-60">
                                    <div class="product-fruit-img">
                                        @if($product->firstMedia)
                                            <img src="{{ asset('storage/images/products/' . $product->firstMedia->file_name ) }}"
                                                 alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ asset('img/cartwhite.png' ) }}" alt="">
                                        @endif
                                        <div class="product-furit-action">
                                            <a wire:click.prevent="addToCart('{{ $product->id }}')"
                                               class="furit-animate-left" title="Add To Cart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                            <a wire:click.prevent="addToWishList('{{ $product->id }}')"
                                               class="furit-animate-right" title="Wishlist">
                                                <i class="fas fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-fruit-content text-center">
                                        <h4>
                                            <a href="{{route('product.show', $product->slug)}}">{{ $product->name }}</a>
                                        </h4>
                                        <span>${{ $product->price }}</span>
                                        <div>
                                            @if($product->tags->count() > 0)
                                                @foreach($product->tags as $tag)
                                                    <label for="" class="small">
                                                        <a href="{{ route('shop.tag', $tag->slug) }}">
                                                            {{ $tag->name }}
                                                            <span>{{ $loop->last ? '' : ',' }}</span>
                                                        </a>
                                                    </label>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No products found.</p>
                        @endforelse
                    </div>
                </div>
                <div id="grid-sidebar2" class="tab-pane fade">
                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-lg-12">
                                <div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
                                    <div class="product-img list-img-width">
                                        @if($product->firstMedia)
                                            <img src="{{ asset('storage/' . $product->firstMedia->file_name ) }}" style="width: 100%;">
                                        @else
                                            <img src="{{ asset('img/cartwhite.png' ) }}" alt="{{ $product->name }}" style="width: 100%;">
                                        @endif
                                    </div>
                                    <div class="product-content-list">
                                        <div class="product-list-info">
                                            <h4>
                                                <a href="{{route('product.show', $product->slug)}}">
                                                    {{ $product->name }}
                                                </a>
                                            </h4>
                                            <span>${{ $product->price }}</span>
                                            @if($product->tags->count() > 0)
                                                @foreach($product->tags as $tag)
                                                    <label>
                                                        <a href="{{ route('shop.tag', $tag->slug) }}">
                                                            {{ $tag->name }}<span>{{ $loop->last ? '' : ',' }}</span>
                                                        </a>
                                                    </label>
                                                @endforeach
                                            @endif
                                            <p>{{ $product->description }}</p>
                                        </div>
                                        <div class="product-list-cart-wishlist">
                                            <div class="product-list-cart">
                                                <a wire:click="addToCart('{{ $product->id }}')"
                                                   class="btn-hover list-btn-style" title="Add To Cart" style="cursor: pointer">
                                                    add to cart
                                                </a>
                                            </div>
                                            <div class="product-list-look">
                                                <a wire:click="addToWishList('{{ $product->id }}')"
                                                   class="btn-hover list-btn-wishlist"
                                                   title="Wishlist" style="cursor: pointer">
                                                    <i class='far fa-heart'></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <h3 style="">No products found.</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {!! $products->appends(request()->all())->onEachSide(1)->links() !!}
    </div>
</div>
