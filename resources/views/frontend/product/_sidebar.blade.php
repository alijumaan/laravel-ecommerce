<div class="shop-sidebar mr-50">

    <div class="sidebar-widget mb-50">
        <h3 class="sidebar-title">Search Products</h3>
        <div class="sidebar-search">
            {!! Form::open(['route' => 'search', 'method' => 'get']) !!}
            {!! Form::text('keyword', old('keyword', request()->keyword), ['placeholder' => 'Search Products...']) !!}
            {!! Form::button('<i class="fas fa-search"></i>', ['type' => 'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>

{{--    <div class="sidebar-widget mb-40">--}}
{{--        <h3 class="sidebar-title">Filter by Price</h3>--}}
{{--        <div class="price_filter">--}}
{{--            <div id="slider-range"></div>--}}
{{--            <div class="price_slider_amount">--}}
{{--                <div class="label-input">--}}
{{--                    <label>price : </label>--}}
{{--                    <input type="text" id="amount" name="price"  placeholder="Add Your Price" />--}}
{{--                </div>--}}
{{--                <button type="button">Filter</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="sidebar-widget sidebar-overflow mb-45">--}}
{{--        <h3 class="sidebar-title">color</h3>--}}
{{--        <div class="product-color">--}}
{{--            <ul>--}}
{{--                <li class="red">b</li>--}}
{{--                <li class="pink">p</li>--}}
{{--                <li class="blue">b</li>--}}
{{--                <li class="sky">b</li>--}}
{{--                <li class="green">y</li>--}}
{{--                <li class="purple">g</li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="sidebar-widget mb-40">--}}
{{--        <h3 class="sidebar-title">size</h3>--}}
{{--        <div class="product-size">--}}
{{--            <ul>--}}
{{--                <li><a href="#">xl</a></li>--}}
{{--                <li><a href="#">m</a></li>--}}
{{--                <li><a href="#">l</a></li>--}}
{{--                <li><a href="#">ml</a></li>--}}
{{--                <li><a href="#">lm</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="sidebar-widget mb-40">--}}
{{--        <h3 class="sidebar-title">tag</h3>--}}
{{--        <div class="product-tags">--}}
{{--            <ul>--}}
{{--                <li><a href="#">Clothing</a></li>--}}
{{--                <li><a href="#">Bag</a></li>--}}
{{--                <li><a href="#">Women</a></li>--}}
{{--                <li><a href="#">Tie</a></li>--}}
{{--                <li><a href="#">Women</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">CATEGORIES</h3>
{{--        <hr style="margin-top: 0; margin-bottom: 10px; border: solid 1px;">--}}
        <div class="price_filter">
            <div id="slider-range"></div>
            <div class="price_slider_amount">
                <div class="sidebar-categories">
                    <ul>
                        @foreach($global_categories as $global_category)
                            <li><a href="{{ route('category.product', $global_category->slug) }}">{{ $global_category->name }} <span>{{ $global_category->products->count() }}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">TAGS</h3>
        <hr style="margin-top: 0; margin-bottom: 10px; border: solid 1px;">
        <div class="price_filter">
            <div id="slider-range"></div>
            <div class="price_slider_amount">
                <div class="sidebar-categories">
                    <ul>
                        @foreach($global_tags as $global_tag)
                            <span style="background: #ebebeb none repeat scroll 0 0; color: #333;
                            display: inline-block; font-size: 12px; line-height: 20px; margin:
                            5px 5px 0 0; padding: 5px 15px; text-transform: capitalize;">
                                <a href="{{ route('tag.products', $global_tag->slug) }}">{{ $global_tag->name }}
                                    ({{ $global_tag->products_count }})
                                </a></span>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">RECENT PRODUCTS</h3>
            <hr style="margin-top: 0; margin-bottom: 10px; border: solid 1px;">
            <ul>
                @foreach( $recent_products as $recent_product)
                    <li>
                        <div class="post-wrapper d-flex">
                                <a href="{{ route('front.products.show', $recent_product->slug) }}">
                                    @if($recent_product->media->count() > 0)
                                        <img class="avatar pb-3" src="{{ asset('storage/' . $recent_product->media->first()->file_name ) }}">
                                    @endif
                                </a>
                            <div class="">
                                <h4><a href="{{ route('front.products.show', $recent_product->slug) }}">{{ \Illuminate\Support\Str::limit($recent_product->name, 20, ' ...') }}</a></h4>
                                <p>${{ $recent_product->price }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
    </div>

    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">RECENT REVIEWS</h3>
        <hr style="margin-top: 0; margin-bottom: 10px; border: solid 1px;">
        <ul>
            @foreach($recent_reviews as $recent_review)
                <li>
                    <div class="post-wrapper d-flex">
                        <div class="">
                            <img src="{{ get_gravatar($recent_review->email, 50) }}" alt="{{ $recent_review->name }}">
                        </div>
                        <div class="ml-3 p-0">
                            @if(isset($recent_review->product->slug))
                                <a href="{{ route('front.products.show', $recent_review->product->slug) }}">
                                <h6><span class="text-success">{{ $recent_review->name }}</span>
                                    <small> review on :
                                    {{ $recent_review->product->name }}
                                    </small>
                                </h6>
                                <p>{!! \Illuminate\Support\Str::limit($recent_review->review, 30, '...') !!}</p>
                                </a>
                            @else

                                <h6><span class="text-success">{{ $recent_review->name }}</span>
                                    <small> review : </small>
                                </h6>
                                <p>{!! \Illuminate\Support\Str::limit($recent_review->review, 30, '...') !!}</p>

                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">ARCHIVES</h3>
        <hr style="margin-top: 0; margin-bottom: 10px; border: solid 1px;">
        <ul>
            @foreach($global_archives as $key => $val)
                <li><a href="{{ route('archive.product', $key.'-'.$val) }}">{{ date("F", mktime(0, 0, 0, $key, 1)) . ' ' . $val }}</a></li>
            @endforeach
        </ul>
    </div>

</div>
