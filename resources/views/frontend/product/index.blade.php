@extends('frontend.layouts.app')

@section('content')

    <div class="shop-page-wrapper shop-page-padding ptb-100">
        <div class="container-fluid m-auto">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.product._sidebar')
                </div>

                <div class="col-lg-9">
                    <div class="shop-product-wrapper">
                        <div class="shop-bar-area">

                            <div class="shop-bar pb-60">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="shop-found-selector">
                                            <div class="shop-selector">
                                                {!! Form::open(['route' => 'frontend.products.index', 'method' => 'get']) !!}
                                                <label>Order By : </label>
                                                <label>
                                                    {!! Form::select('order_by', ['' => 'Default', 'asc' => 'A to Z', 'desc' => 'Z to A'], old('order_by', request()->input('order_by'))) !!}
                                                </label>
                                            </div>
{{--                                            <div class="shop-selector">--}}
{{--                                                <label>Sort By : </label>--}}
{{--                                                <label>--}}
{{--                                                    {!! Form::select('sort_by', ['' => 'Default', 'name' => 'Name', 'created_at' => 'Date' ], old('sort_by', request()->input('sort_by'))) !!}--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="shop-selector">--}}
{{--                                                <label>Show : </label>--}}
{{--                                                <label>--}}
{{--                                                    {!! Form::select('limit_by', ['' => 'Default', '10' => '10', '15' => '15', '20' => '20', '25' => '25', '30' => '30' ], old('limit_by', request()->input('limit_by'))) !!}--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="shop-selector">
                                            {!! Form::button('Find', ['class' => 'btn-sm btn btn-outline-link', 'type' => 'submit']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
{{--                                    <div class="col-2">--}}
{{--                                    </div>--}}
                                </div>
                                <div class="shop-filter-tab">
                                    <div class="shop-tab nav" role=tablist>
                                        <a class="active" href="#grid-sidebar14" data-toggle="tab" role="tab" aria-selected="true">
                                            <i class="fas fa-border-all"></i>

                                        </a>
                                        <a href="#grid-sidebar13" data-toggle="tab" role="tab" aria-selected="false">
                                            <i class="fas fa-bars"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="shop-product-content tab-content">
                                <div id="grid-sidebar13" class="tab-pane fade">
                                    <div class="row">
                                        @forelse($products as $product)
                                            <div class="col-lg-12">
                                                <div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
                                                    <div class="product-img list-img-width">
                                                        <a href="{{route('frontend.products.show', $product->slug)}}">
                                                            @if($product->media->first()->file_name)
                                                                <img src="{{ asset('storage/' . $product->media->first()->file_name ) }}">
                                                            @else
                                                                <img src="{{ asset('frontend/img/default/no-img.png' ) }}" alt="{{ $product->name }}">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="product-content-list">
                                                        <div class="product-list-info">
                                                            <h4><a href="{{route('frontend.products.show', $product->slug)}}">{{ $product->name }}</a></h4>
                                                            <span>${{ $product->price }}</span>
                                                            @if($product->tags->count() > 0)
                                                            @foreach($product->tags as $tag)
                                                                <label for="" class="badge bg-success">
                                                                    <a href="{{ route('tag.products', $tag->slug) }}">{{ $tag->name }}</a>
                                                                </label>
                                                            @endforeach
                                                            @endif
                                                            <p>{{ $product->description }}</p>
                                                        </div>
                                                        <div class="product-list-cart-wishlist">

                                                            <div class="product-list-cart">
                                                                <a class="btn-hover list-btn-style" href="{{route('cart.add', $product->id)}}">add to cart</a>
                                                            </div>
                                                            @auth
                                                            <div class="product-list-look">
                                                                <a class="btn-hover list-btn-wishlist" href="{{route('frontend.products.show', $product->slug)}}">
                                                                    <i class='far fa-heart'></i>
                                                                </a>
                                                            </div>
                                                            @endauth
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @empty
                                            <h3 style="">No products found.</h3>
                                        @endforelse
                                    </div>
                                </div>
                                <div id="grid-sidebar14" class="tab-pane fade active show">
                                    <div class="row">
                                        @forelse($products as $product)
                                            <div class="col-lg-6 col-md-6" style="max-width: 30%;">
                                                <div class="product-wrapper mb-30">
                                                    <div class="product-img">
                                                        <a href="{{route('frontend.products.show', $product->slug)}}">
                                                            @if($product->media->first()->file_name)
                                                                <img src="{{ asset('storage/' . $product->media->first()->file_name ) }}">
                                                            @else
                                                                <img src="{{ asset('frontend/img/default/no-img.png' ) }}" alt="{{ $product->name }}">
                                                            @endif
                                                        </a>
{{--                                                        <span class="bg-danger">hot</span>--}}
                                                        <div class="product-action">
                                                            <a class="animate-top" title="Add To Cart" href="{{route('cart.add', $product->id)}}">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                            <a class="animate-right" title="Quick View" href="{{route('frontend.products.show', $product->slug)}}">

                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h4><a href="{{route('frontend.products.show', $product->slug)}}">{{ $product->name }}</a></h4>
                                                        <span>${{ $product->price }}</span>
                                                    </div>
                                                    @if($product->tags->count() > 0)
                                                    @foreach($product->tags as $tag)
                                                        <label for="" class="badge bg-success">
                                                            <a href="{{ route('tag.products', $tag->slug) }}">{{ $tag->name }}</a>
                                                        </label>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                            <h3>No Products found.</h3>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

