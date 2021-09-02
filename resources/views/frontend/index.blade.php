@extends('layouts.app')
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
                                <a href="{{ route('shop.index', $category->slug) }}">
                                    <div class="product-fruit-img">
                                        @if($category->cover)
                                            <img src="{{ asset('storage/images/categories/' . $category->cover) }}"
                                                 alt="{{ $category->name }}" style="max-height: 400px;">
                                        @else
                                            <img src="{{ asset('img/no-img.png' ) }}" alt="">
                                        @endif
                                    </div>
                                </a>
                                <div class="product-fruit-content text-center">
                                    <h4>
                                        <a href="{{ route('shop.index', $category->slug) }}">
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
    </div>
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

    <!-- TRENDING PRODUCTS -->
    <livewire:frontend.top-trending-products />

    <!-- services area start -->
    <div class="fruits-services ptb-200">
        <div class="fruits-services-wrapper">
            <div class="single-fruits-services">
                <div class="fruits-services-img">
                    <img src="{{asset('img/logo.png')}}" alt="">
                </div>
                <div class="fruits-services-content">
                    <h4>Free Shipping</h4>
                    <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is simply
                        industry.</p>
                </div>
            </div>
            <div class="single-fruits-services">
                <div class="fruits-services-img">
                    <img src="{{asset('img/logo.png')}}" alt="">
                </div>
                <div class="fruits-services-content">
                    <h4>Money Guarentee.</h4>
                    <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is simply
                        industry.</p>
                </div>
            </div>
            <div class="single-fruits-services">
                <div class="fruits-services-img">
                    <img src="{{asset('img/logo.png')}}" alt="">
                </div>
                <div class="fruits-services-content">
                    <h4>Online Support</h4>
                    <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is simply
                        industry.</p>
                </div>
            </div>
        </div>
</div>
    <!-- services area end -->
@endsection

