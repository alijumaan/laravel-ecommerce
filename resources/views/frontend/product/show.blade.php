@extends('layouts.app')
@section('content')
    <div class="product-details ptb-100 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-7 col-12">
                    <div class="product-details-img-content">
                        <div class="product-details-tab mr-70">
                            @if($product->media->count())
                                <div class="product-details-large tab-content">
                                    @foreach ($product->media as $media)
                                        <div class="tab-pane {{ $loop->index == 0 ? 'active' : '' }} show fade"
                                             id="pro-details{{ $loop->index }}" role="tabpanel">
                                            <div class="easyzoom easyzoom--overlay">
                                                @if($product->media)
                                                    <a href="{{ asset('storage/images/products/' . $media->file_name ) }}">
                                                        <img src="{{ asset('storage/images/products/' . $media->file_name ) }}"
                                                             alt="{{ $product->name }}">
                                                    </a>
                                                @else
                                                    <img src="{{ asset('img/no-img.png' ) }}"
                                                         alt="{{ $product->name }}">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="product-details-small nav mt-12" role=tablist>
                                    @foreach ($product->media as $media)
                                        <a class="{{ $loop->index == 0 ? 'active' : '' }} mr-12"
                                           href="#pro-details{{ $loop->index }}" data-toggle="tab" role="tab"
                                           aria-selected="true">
                                            <img style="width: 90px;" src="{{ asset('storage/images/products/' . $media->file_name ) }}"
                                                 alt="{{ $product->name }}">
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <img src="{{ asset('img/no-img.png' ) }}" alt="{{ $product->name }}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5 col-12">
                    <div class="product-details-content">
                        <h3>{{ $product->name }}</h3>
                        <div class="rating-number">
                            <div class="quick-view-number">
                                <span class="score">
                                    <div class="score-wrap">
                                        @if($product->reviews_avg_rating)
                                            @for($i = 0; $i < 5; $i++)
                                                <span class="stars-active">
                                                    <i class="{{ round($product->reviews_avg_rating) <= $i ? 'far' : 'fas' }} fa-star"></i>
                                                </span>
                                            @endfor
                                        @else
                                            @for($i = 0; $i < 5; $i++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                        @endif
                                    </div>
                                </span>
                                <span> Ratting (S)</span>
                            </div>
                        </div>
                        <div class="details-price">
                            <span>${{ $product->price }}</span>
                        </div>
                        <p>{{ $product->description }}</p>

                        <livewire:frontend.add-product-to-cart-or-wishlist :product="$product"/>

                        <div class="product-details-cati-tag mt-35">
                            <ul>
                                <li class="categories-title">Categories :</li>
                                <li><a href="{{ route('shop.index', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                            </ul>
                        </div>
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Tags :</li>
                                <li>
                                    @if($product->tags->count() > 0)
                                        @foreach($product->tags as $tag)
                                            {{ $tag->name }}
                                            <span>{{ $loop->last ? '' : ',' }}</span>
                                        @endforeach
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="product-share">
                            <ul>
                                <li class="categories-title">Share :</li>
                                <li>
                                    @include('partials.frontend.shareBtn')
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-description-review-area pb-90">
        <div class="container">
            <div class="product-description-review text-center">
                <div class="description-review-title nav" role=tablist>
                    <a class="active" href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">
                        Reviews ({{ $product->reviews->count() }})
                    </a>
                    <a href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
                        Description
                    </a>
                </div>
                <div class="description-review-text tab-content">
                    <div class="tab-pane fade" id="pro-dec" role="tabpanel">
                        <p>{!! $product->details !!}</p>
                    </div>
                    <div class="tab-pane active show fade" id="pro-review" role="tabpanel">
                        <div class="page-blog-details section-padding--lg bg--white pt-0">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-9 col-12">
                                        <div class="blog-details content">
                                            <div class="comments_area">
                                                <ul class="comment__list">
                                                    @forelse($product->reviews as $review)
                                                        <li>
                                                            <div class="wn__comment">
                                                                <div class="">
                                                                    @if($review->user && $review->user->user_image)
                                                                        <img class="rounded-circle"
                                                                             src="{{ asset('storage/images/users/' . $review->user->user_image) }}"
                                                                             alt="" width="50">
                                                                    @else
                                                                        <img src="{{ get_gravatar($review->email, 50) }}"
                                                                            alt="{{ $review->name }}">
                                                                    @endif
                                                                </div>
                                                                <div class="content">
                                                                    {{ $review->name }}
                                                                    <div class="comnt__author d-block d-sm-flex">
                                                                        <small>{{ $review->created_at ? $review->created_at->format('d M, Y') : '' }}</small>
                                                                    </div>
                                                                    <div>
                                                                        @if($review->rating)
                                                                            @for($i = 0; $i < 5; $i++)
                                                                                <i class="{{ round($review->rating) <= $i ? 'far' : 'fas' }} fa-star"></i>
                                                                            @endfor
                                                                        @endif
                                                                    </div><div>
                                                                    <strong style="width: 100%; font-size: 14px;">{{ $review->title }}</strong>
                                                                    <p style="width: 100%; font-size: 14px;">{{ $review->content }}</p></div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @empty
                                                        <a class="m-2">Be the first to write your review!</a>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:frontend.related-products-component :relatedProducts="$relatedProducts" />
@endsection

