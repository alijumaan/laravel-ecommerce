@extends('frontend.layouts.app')

@section('content')
    @include('partials.frontend.sliders')
    <div class="container">
        <!-- banner area start -->
        <div class="banner-area pt-0 pb-100 fix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="card-body">
                            <div class="furits-banner-wrapper mb-30 wow fadeInLeft">
                                <img src="{{ asset('frontend/img/banner/49.jpg') }}" alt="">
                                <div class="furits-banner-content">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card-body">
                            <div class="furits-banner-wrapper mb-30 wow fadeInUp">
                                <img src="{{ asset('frontend/img/banner/50.jpg') }}" alt="">
                                <div class="furits-banner-content">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card-body">
                            <div class="furits-banner-wrapper mb-30 wow fadeInUp">
                                <img src="{{ asset('frontend/img/banner/51.png') }}" alt="">
                                <div class="furits-banner-content">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner area end -->

        <!-- product area start -->
        <div class="product-style-area gray-bg-4 pb-105">

            <div class="container">

                <div class="section-title-furits bg-shape text-center mb-80">
                    <img src="{{ asset('frontend/img/icon-img/49.png') }}" alt="">
                    <h2>BROWSE OUR CATEGORIES</h2>
                </div>
                <div class="row">
                    @forelse($categories as $category)
                        <div class="col-6">
                            <div class="">
                                <a href="{{ route('category.product', $category->slug) }}">
                                    <div class="product-fruit-img">
                                        @if($category->cover)
                                            <img src="{{ asset('storage/assets/images/categories/' . $category->cover) }}"
                                                 alt="{{ $category->name }}">
                                        @else
                                            <img src="{{ asset('frontend/img/default/no-img.png' ) }}" alt="">
                                        @endif
                                    </div>
                                </a>
                                <div class="product-fruit-content text-center">
                                    <h4>
                                        <a href="{{route('frontend.products.show', $category->slug)}}">
                                            {{ $category->name }}
                                        </a>
                                    </h4>
                                    <span>{{ $category->price }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No categories found.</p>
                    @endforelse
                </div>

            </div>

        </div>
        <!-- product area end -->

        <!-- banner area start -->
        <div class="fruits-choose-area pb-65 bg-img" style="background-image: url('{{ asset('frontend/img/banner/53.png') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xl-8 col-12">
                        <div class="fruits-choose-wrapper-all">
                            <div class="fruits-choose-title">
                                <h2>WHY CHOOSE US ?</h2>
                            </div>
                            <div class="fruits-choose-wrapper">
                                <div class="single-fruits-choose">
                                    <div class="fruits-choose-serial">
                                        <h3>01</h3>
                                    </div>
                                    <div class="fruits-choose-content">
                                        <h4>Free Shipping.</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="single-fruits-choose">
                                    <div class="fruits-choose-serial">
                                        <h3>02</h3>
                                    </div>
                                    <div class="fruits-choose-content">
                                        <h4>100% ORIGINAL PRODUCTS.</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="single-fruits-choose">
                                    <div class="fruits-choose-serial">
                                        <h3>03</h3>
                                    </div>
                                    <div class="fruits-choose-content">
                                        <h4>Online Support.</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner area end -->

        <!-- All product start -->
        <div id="all-products" class="product-style-area pt-130 pb-30 wow fadeInUp">
            <div class="container">
                <div class="section-title-furits text-center mb-95">
                    <img src="{{ asset('frontend/img/icon-img/49.png') }}" alt="">
                    <h2>TOP TRENDING PRODUCTS</h2>
                </div>
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-lg-4 col-xl-3 col-md-6">
                            <div class="product-fruit-wrapper mb-60">
                                <div class="product-fruit-img">
                                    @if($product->media->first()->file_name)
                                        <img src="{{ asset('storage/' . $product->media->first()->file_name ) }}"
                                             alt="{{ $product->name }}">
                                    @else
                                        <img src="{{ asset('frontend/img/default/no-img.png' ) }}" alt="">
                                    @endif
                                    <div class="product-furit-action">
                                        <a class="furit-animate-left" title="Add To Cart"
                                           href="{{route('cart.add', $product->id)}}">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                        <a class="furit-animate-right" title="Wishlist"
                                           href="{{route('frontend.products.show', $product->slug)}}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-fruit-content text-center">
                                    <h4>
                                        <a href="{{route('frontend.products.show', $product->slug)}}">{{ $product->name }}</a>
                                    </h4>
                                    <span>${{ $product->price }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No products found.</p>
                    @endforelse
                </div>
                <div>
                    {!! $products->links() !!}
                </div>
            </div>

        </div>
        <!-- All products end -->
    </div>
@endsection

