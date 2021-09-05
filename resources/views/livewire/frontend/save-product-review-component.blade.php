<div class="comment_respond">
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
</div>
