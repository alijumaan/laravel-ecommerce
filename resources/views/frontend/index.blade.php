@extends('frontend.layouts.app')

@section('content')

<div class="p-1 text-white text-center" style="background-image: url(frontend/img/bg/12.jpg)">Up to 15% off</div>

    <div class="slider-area">
        <div class="slider-active-2 owl-carousel">
            <div class="single-slider-4 bg-img furits-slider" style="background-image: url(frontend/img/slider/carousel.png)">
                <div class="container">
                    <div class="fadeinup-animated furits-content text-left">
                        <img class="animated" src="" alt="">
                        <p class="animated">

                        </p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="slider-social">
            <span><a class="furits-slider-btn btn-hover animated" href="{{ route('frontend.products.index') }}">Shop Now</a></span>
        </div>
    </div>

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
                <h2>Our Newest Products</h2>
            </div>
            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-xl-3 col-md-6">
                        <div class="product-fruit-wrapper mb-60">
                        <div class="product-fruit-img">
                            @if($product->media->count() > 0)
                                <img src="{{ asset('storage/' . $product->media->first()->file_name ) }}">
                            @else
                                <img src="{{ asset('storage/app/public/images/default.jpeg' ) }}">
                            @endif
                            <div class="product-furit-action">
                                <a class="furit-animate-left" title="Add To Cart" href="{{route('cart.add', $product->id)}}">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                                <a class="furit-animate-right" title="Wishlist" href="{{route('frontend.products.show', $product->slug)}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-fruit-content text-center">
                            <h4><a href="{{route('frontend.products.show', $product->slug)}}">{{ $product->name }}</a></h4>
                            <span>${{ $product->price }}</span>
                        </div>
                        </div>
                    </div>
                @empty
                    <p>No products found.</p>
                @endforelse
            </div>

        </div>

    </div>
    <!-- product area end -->

    <!-- banner area start -->
    <div class="fruits-choose-area pb-65 bg-img" style="background-image: url(frontend/img/banner/53.png)">
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
                <h2>More Fresh Products</h2>
            </div>
            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-xl-3 col-md-6">
                        <div class="product-fruit-wrapper mb-60">
                        <div class="product-fruit-img">
                            @if($product->media->count() > 0)
                                <img src="{{ asset('storage/' . $product->media->first()->file_name ) }}">
                            @endif
                            <div class="product-furit-action">
                                <a class="furit-animate-left" title="Add To Cart" href="{{route('cart.add', $product->id)}}">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                                <a class="furit-animate-right" title="Wishlist" href="{{route('frontend.products.show', $product->slug)}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-fruit-content text-center">
                            <h4><a href="{{route('frontend.products.show', $product->slug)}}">{{ $product->name }}</a></h4>
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

    <!-- services area start -->
    <div class="fruits-services ptb-200">
        <div class="fruits-services-wrapper">
            <div class="single-fruits-services">
                <div class="fruits-services-img">
                    <img src="{{asset('frontend/img/logo/logo.png')}}" alt="">
                </div>
                <div class="fruits-services-content">
                    <h4>Free Shipping</h4>
                    <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is simply industry.</p>
                </div>
            </div>
            <div class="single-fruits-services">
                <div class="fruits-services-img">
                    <img src="{{asset('frontend/img/logo/logo.png')}}" alt="">
                </div>
                <div class="fruits-services-content">
                    <h4>Money Guarentee.</h4>
                    <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is simply industry.</p>
                </div>
            </div>
            <div class="single-fruits-services">
                <div class="fruits-services-img">
                    <img src="{{asset('frontend/img/logo/logo.png')}}" alt="">
                </div>
                <div class="fruits-services-content">
                    <h4>Online Support</h4>
                    <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is simply industry.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- services area end -->
@endsection

