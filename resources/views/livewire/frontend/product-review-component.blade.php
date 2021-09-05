<div class="blog-details content">
    <div class="comments_area pb-5">
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
                                <p style="width: 100%; font-size: 14px;">{{ $review->content }}</p></div>
                        </div>
                    </div>
                </li>
            @empty
                <a class="m-2">Be the first to write your review!</a>
            @endforelse
        </ul>
    </div>
    <div class="comment_respond">
        @if($canRate)
            @if($showForm)
                <h3 class="reply_title">{{ $currentRatingId ? 'Your Rating' : 'Leave a Reply' }}</h3>
                <form wire:submit.prevent="rate()" class="review__form score">
                    <div class="score-wrap">
                        <label for="star1">
                            <input hidden wire:model="rating" type="radio" id="star1" name="rating" value="1" />
                            <span class="stars-active" data-value="1">
                                <i class=" @if($rating >= 1 ) fas fa-star @else far fa-star @endif" style="cursor: pointer"></i>
                            </span>
                        </label>
                        <label for="star2">
                            <input hidden wire:model="rating" type="radio" id="star2" name="rating" value="2" />
                            <span class="stars-active" data-value="2">
                                <i class=" @if($rating >= 2 ) fas fa-star @else far fa-star @endif" style="cursor: pointer"></i>
                            </span>
                        </label>
                        <label for="star3">
                            <input hidden wire:model="rating" type="radio" id="star3" name="rating" value="3" />
                            <span class="stars-active" data-value="3">
                                <i class=" @if($rating >= 3 ) fas fa-star @else far fa-star @endif" style="cursor: pointer"></i>
                            </span>
                        </label>
                        <label for="star4">
                            <input hidden wire:model="rating" type="radio" id="star4" name="rating" value="4" />
                            <span class="stars-active" data-value="4">
                                <i class=" @if($rating >= 4 ) fas fa-star @else far fa-star @endif" style="cursor: pointer"></i>
                            </span>
                        </label>
                        <label for="star5">
                            <input hidden wire:model="rating" type="radio" id="star5" name="rating" value="5" />
                            <span class="stars-active" data-value="5">
                                <i class=" @if($rating >= 5 ) fas fa-star @else far fa-star @endif" style="cursor: pointer"></i>
                            </span>
                        </label>
                    </div>
                    <p>@error('rating')<span class="text-danger">{{ $message }}</span>@enderror</p>
                    <div class="input__box text-left">
                        <textarea class="form-control" rows="5" wire:model.lazy="content">{{ old('review') }}</textarea>
                        @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="submite__btn">
                        @if($currentRatingId)
                            @auth
                                <button type="submit" wire:click.prevent="delete({{ $currentRatingId }})" class="btn btn-danger">
                                    Delete
                                </button>
                                <button type="submit" class="btn btn-dark rounded shadow-lg">Update</button>
                            @endauth
                        @else
                            <button type="submit" class="btn btn-dark rounded shadow-lg">Rate</button>
                        @endif
                    </div>

                </form>
            @endif
        @else
            <div class="alert alert-danger" role="alert">
                <small>Must buy this product before write a review.</small>
            </div>
        @endif
    </div>
</div>
