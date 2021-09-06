<div class="shop-sidebar mr-50">
    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">CATEGORIES</h3>
        @forelse($shop_categories_menu as $category)
            <div class="py-2 px-4 bg-dark text-white mb-3">
                <strong class="small text-uppercase font-weight-bold">
                    <a class="text-decoration-none text-white" href="{{ route('shop.index', $category->slug) }}">
                        {{ $category->name }}
                    </a>
                </strong>
            </div>
            <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                @forelse($category->appearedChildren as $sub_category)
                    <li class="mb-2">
                        <a class="reset-anchor" href="{{ route('shop.index', $sub_category->slug) }}">
                            {{ $sub_category->name }}
                        </a>
                    </li>
                @empty
                @endforelse
            </ul>
        @empty
        @endforelse
    </div>
    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">TAGS</h3>
        <hr style="margin-top: 0; margin-bottom: 10px; border: solid 1px;">
        <div class="price_filter">
{{--            <div id="slider-range"></div>--}}
            <div class="price_slider_amount">
                <div class="sidebar-categories">
                    <ul>
                        @foreach($shop_tags_menu as $tag)
                            <span style="background: #ebebeb none repeat scroll 0 0; color: #333;
                            display: inline-block; font-size: 12px; line-height: 20px; margin:
                            5px 5px 0 0; padding: 5px 15px; text-transform: capitalize;">
                                <a href="{{ route('shop.tag', $tag->slug) }}">
                                    {{ $tag->name }}
                                    ({{ $tag->products_count }})
                                </a>
                            </span>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">RECENT REVIEWS</h3>
        <hr style="margin-top: 0; margin-bottom: 10px; border: solid 1px;">
        <ul>
            @foreach($recent_reviews as $recent_review)
                <li>
                    <div class="post-wrapper d-flex">
                        <div class="mb-2">
                            <img src="{{ get_gravatar($recent_review->email, 50) }}" alt="{{ $recent_review->name }}">
                        </div>
                        <div class="ml-3 p-0">
                            @if(isset($recent_review->product->slug))
                                <p>
                                    <span class="">{{ $recent_review->user->full_name }}</span>
                                    <small> review on :
                                        {{ $recent_review->product->name }}
                                    </small>
                                </p>
                                <p>{!! \Illuminate\Support\Str::limit($recent_review->review, 30, '...') !!}</p>
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
</div>
