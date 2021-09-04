<div class="comment_respond">
    @if($hideForm != true)
        <h3 class="reply_title">Leave a Reply<small></small></h3>
        <form wire:submit.prevent="rate()" class="review__form">
            <div class="rating">
                <label for="star1">
                    <input hidden wire:model="rating" type="radio" id="star1" name="rating" value="1" />
                    <span class="rating-star" data-value="1"></span>
                    {{-- @if($rating >= 1 ) text-indigo-500 @else text-grey @endif --}}
                </label>
                <label for="star2">
                    <input hidden wire:model="rating" type="radio" id="star2" name="rating" value="2" />
                    <span class="rating-star" data-value="2"></span>
                </label>
                <label for="star3">
                    <input hidden wire:model="rating" type="radio" id="star3" name="rating" value="3" />
                    <span class="rating-star" data-value="3"></span>
                </label>
                <label for="star4">
                    <input hidden wire:model="rating" type="radio" id="star4" name="rating" value="4" />
                    <span class="rating-star" data-value="4"></span>
                </label>
                <label for="star5">
                    <input hidden wire:model="rating" type="radio" id="star5" name="rating" value="5" />
                    <span class="rating-star" data-value="5"></span>
                </label>
            </div>
            <p>@error('rating')<span class="text-danger">{{ $message }}</span>@enderror</p>
            <div class="input__box text-left">
                <textarea class="form-control" rows="5" wire:model.lazy="content">{{ old('review') }}</textarea>
                @error('content')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="submite__btn">
                @if($currentId)
                    @auth
                        <button type="submit" wire:click.prevent="delete({{ $currentId }})" class="btn btn-danger">
                            Delete
                        </button>
                    @endauth
                @else
                    <button class="btn btn-dark">Rate</button>
                @endif
            </div>
        </form>
    @endif
</div>

{{--<div class="comment_respond">--}}
{{--    <section class="">--}}
{{--        <div class="">--}}
{{--            <div class="flex flex-col items-center md:flex-row">--}}
{{--                <div class="w-full mt-16 md:mt-0">--}}
{{--                    <div class="relative z-10 h-auto p-4 py-10 overflow-hidden bg-white border-b-2 border-gray-300 rounded-lg shadow-2xl px-7">--}}
{{--                        <div class="w-full space-y-5">--}}
{{--                            <p class="reply_title">--}}
{{--                                Rate this product--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        @if($hideForm != true)--}}
{{--                            <form wire:submit.prevent="rate()">--}}
{{--                                <div class="block max-w-3xl px-1 py-2 mx-auto">--}}
{{--                                    @error('rating')--}}
{{--                                    <p class="text-danger">{{ $message }}</p>--}}
{{--                                    @enderror--}}
{{--                                    <div class="flex space-x-1 rating">--}}
{{--                                        <label for="star1">--}}
{{--                                            <input hidden wire:model="rating" type="radio" id="star1" name="rating" value="1" />--}}
{{--                                            <span class="rating-star" data-value="1"></span>--}}
{{--                                        </label>--}}
{{--                                        <label for="star2">--}}
{{--                                            <input hidden wire:model="rating" type="radio" id="star2" name="rating" value="2" />--}}
{{--                                            <span class="rating-star" data-value="2"></span>--}}
{{--                                        </label>--}}
{{--                                        <label for="star3">--}}
{{--                                            <input hidden wire:model="rating" type="radio" id="star3" name="rating" value="3" />--}}
{{--                                            <span class="rating-star" data-value="3"></span>--}}
{{--                                        </label>--}}
{{--                                        <label for="star4">--}}
{{--                                            <input hidden wire:model="rating" type="radio" id="star4" name="rating" value="4" />--}}
{{--                                            <span class="rating-star" data-value="4"></span>--}}
{{--                                        </label>--}}
{{--                                        <label for="star5">--}}
{{--                                            <input hidden wire:model="rating" type="radio" id="star5" name="rating" value="5" />--}}
{{--                                            <span class="rating-star" data-value="5"></span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="my-5">--}}
{{--                                        @error('content')--}}
{{--                                        <p class="text-danger">{{ $message }}</p>--}}
{{--                                        @enderror--}}
{{--                                        <textarea wire:model.lazy="content" name="description" class="form-control" placeholder="content.."></textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="">--}}
{{--                                    @if($currentId)--}}
{{--                                        @auth--}}
{{--                                            <button type="submit" wire:click.prevent="delete({{ $currentId }})" class="btn btn-danger">--}}
{{--                                                Delete--}}
{{--                                            </button>--}}
{{--                                        @endauth--}}
{{--                                    @else--}}
{{--                                        <button type="submit" class="btn btn-dark">Rate</button>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--</div>--}}
