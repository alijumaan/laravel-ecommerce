@extends('frontend.layouts.app')

@section('style')
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">--}}

@endsection
@section('content')
    <div class="product-details ptb-100 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-7 col-12">
                    <div class="product-details-img-content">
                        <div class="product-details-tab mr-70">
                            <div class="product-details-large tab-content">
                                @if($product->media->count() > 0)
                                @foreach ($product->media as $media)
                                    <div class="tab-pane {{ $loop->index == 0 ? 'active' : '' }} show fade" id="pro-details{{ $loop->index }}" role="tabpanel">

                                    <div class="easyzoom easyzoom--overlay">
                                        @if($product->media)
                                        <a href="{{ asset('storage/' . $media->file_name ) }}">
                                        <img src="{{ asset('storage/' . $media->file_name ) }}" alt="{{ $product->name }}">
                                        </a>
                                        @else

                                        <img src="{{asset('frontend/images/products/default.jpg') }}" alt="">

                                        <img src="{{asset('frontend/images/default.jpg') }}" alt="">

                                        @endif

                                    </div>
                                </div>

                                @endforeach
                                @else
                                <img src="{{ asset('frontend/images/default.jpg') }}" alt="{{ $product->name }}">
                                @endif
                            </div>

                            <div class="product-details-small nav mt-12" role=tablist>
                                @foreach ($product->media as $media)
                                    <a class="{{ $loop->index == 0 ? 'active' : '' }} mr-12" href="#pro-details{{ $loop->index }}" data-toggle="tab" role="tab" aria-selected="true">
                                        <img style="width: 90px;" src="{{ asset('storage/' . $media->file_name ) }}" alt="{{ $product->name }}">
                                    </a>
                                @endforeach
                            </div>

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
                                        <span class="stars-active" style="width: {{ $product->rate()*20 }}%">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>

                                        <span class="stars-inactive">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                </span>
                                <span>{{ $product->ratings()->count() }} Ratting (S)</span>
                            </div>
                        </div>

                        <div class="details-price">
                            <span>${{ $product->price }}</span>
                        </div>
                        <p>{{ $product->description }}</p>
{{--                        <div class="quick-view-select">--}}
{{--                            <div class="select-option-part">--}}
{{--                                <label>Size*</label>--}}
{{--                                <select class="select">--}}
{{--                                    <option value="">- Please Select -</option>--}}
{{--                                    <option value="">xl</option>--}}
{{--                                    <option value="">ml</option>--}}
{{--                                    <option value="">m</option>--}}
{{--                                    <option value="">sl</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="select-option-part">--}}
{{--                                <label>Color*</label>--}}
{{--                                <select class="select">--}}
{{--                                    <option value="">- Please Select -</option>--}}
{{--                                    <option value="">orange</option>--}}
{{--                                    <option value="">pink</option>--}}
{{--                                    <option value="">yellow</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="quickview-plus-minus">
                            <div class="cart-plus-minus">
                                <input type="text" value="1" name="qtybutton" class="cart-plus-minus-box">
                            </div>
                            <div class="quickview-btn-cart">
                                <a class="btn-hover-black" href="{{route('cart.add', $product->id)}}">add to cart</a>
                            </div>
                            <div class="quickview-btn-wishlist">
                                <a class="btn-hover" href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="product-details-cati-tag mt-35">
                            <ul>
                                <li class="categories-title">Categories :</li>
                                <li><a href="#">{{ $product->category->name }}</a></li>
                            </ul>
                        </div>
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Tags :</li>
                                <li>
                                    @if($product->tags->count() > 0)
                                    @foreach($product->tags as $tag)
                                        <a href="{{ route('tag.products', $tag->slug) }}">{{ $tag->name }}</a>
                                    @endforeach
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="product-share">
                            <ul>
                                <li class="categories-title">Share :</li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
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
                        Reviews ({{ $product->approved_reviews->count() }})
                    </a>
                    <a href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
                        Description
                    </a>
                </div>

                <div class="description-review-text tab-content">
                    <div class="tab-pane fade" id="pro-dec" role="tabpanel">
                        <p>{{ $product->details }}</p>
                    </div>
                    <div class="tab-pane active show fade" id="pro-review" role="tabpanel">

                        <div class="page-blog-details section-padding--lg bg--white pt-0">
                            <div class="container">
                                <div class="row">

                                    <div class="col-lg-9 col-12">
                                        <div class="blog-details content">
                                            <div class="comments_area">
                                                <ul class="comment__list">

                                                    @forelse($product->approved_reviews as $review)
                                                        <li>
                                                            <div class="wn__comment">
                                                                <div class="">
                                                                    <img src="{{ get_gravatar($review->email, 50) }}" alt="{{ $review->name }}">
                                                                </div>
                                                                <div class="content">
                                                                    {{ $review->name }}
                                                                    <div class="comnt__author d-block d-sm-flex">
                                                                        <small>{{ $review->created_at->format('M d  Y') }}</small>
                                                                    </div>
                                                                    <div>
                                                                        <p style="float: center;">{{ $review->review }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @empty

                                                        <a class="m-2">Be the first to write your review!</a>

                                                    @endforelse

                                                </ul>
                                            </div>

                                            @if(auth()->check())
                                            <div class="comment_respond">
                                                <h3 class="reply_title">Leave a Reply <small></small></h3>
{{--                                                <p>Your email address will not be published. Required fields are marked </p>--}}

                                                @if($productFind)
                                                    @if(auth()->user()->rated($product))
                                                        <div class="rating">
                                                            <span class="rating-star" data-value="5"></span>
                                                            <span class="rating-star" data-value="4"></span>
                                                            <span class="rating-star" data-value="3"></span>
                                                            <span class="rating-star" data-value="2"></span>
                                                            <span class="rating-star" data-value="1"></span>
                                                        </div>
                                                    @else
                                                        <div class="rating">
                                                            <span class="rating-star" data-value="5"></span>
                                                            <span class="rating-star" data-value="4"></span>
                                                            <span class="rating-star" data-value="3"></span>
                                                            <span class="rating-star" data-value="2"></span>
                                                            <span class="rating-star" data-value="1"></span>
                                                        </div>
                                                    @endif


                                                {!! Form::open(['route' => ['products.add_review', $product->slug], 'method' => 'post', 'class' => 'review__form']) !!}
                                                <div class="input__box">
                                                    {!! Form::textarea('review', old('review'), ['placeholder' => 'Write a review ']) !!}
                                                    @error('review')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
{{--                                                <div class="input__wrapper clearfix">--}}
{{--                                                    <div class="input__box name one--third">--}}
{{--                                                        {!! Form::text('name', old('name'), ['placeholder' => 'Your name here']) !!}--}}
{{--                                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror--}}
{{--                                                    </div>--}}
{{--                                                    <div class="input__box email one--third">--}}
{{--                                                        {!! Form::email('email', old('email'), ['placeholder' => 'Your email here']) !!}--}}
{{--                                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                                <div class="submite__btn">
                                                    {!! Form::submit('Submit review', ['class' => 'btn btn-dark']) !!}
                                                </div>

                                                {!! Form::close() !!}
                                                @else
                                                    <div class="alert alert-danger" role="alert">
                                                        <small>Must buy this book before write a review.</small>
                                                    </div>
                                                @endif
                                                @else
                                                <hr>
                                                <a href="{{ route('front.login') }}" class="bg-success">Login to write a review!</a>
                                            @endif
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



@endsection
@section('script')
    <script>
        $('.rating-star').click(function() {

            let submitStars = $(this).attr('data-value');

            $.ajax({
                type: 'post',
                url: {{ $product->id }} + '/rate',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'value' : submitStars,
                },
                success: function() {
                    // alert('Rating add successfully');
                    location.reload();
                },
                error: function() {
                    alert('Something was wrong');
                },
            });
        });
    </script>
@endsection
