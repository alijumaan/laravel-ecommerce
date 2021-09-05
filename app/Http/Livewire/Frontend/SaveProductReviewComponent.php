<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class SaveProductReviewComponent extends Component
{
    public $showForm = true;
    public $product;
    public $content;
    public $rating;
    public $currentRatingId;

    public function mount()
    {
        if(auth()->user()){
            $rating = Review::where('user_id', auth()->id())->where('product_id', $this->product->id)->first();

            if (!empty($rating)) {
                $this->rating  = $rating->rating;
                $this->content = $rating->content;
                $this->currentRatingId = $rating->id;
            }
        }
    }

    public function rules()
    {
        return [
            'rating' => ['required'],
            'content' => ['required', 'string']
        ];
    }

    public function rate()
    {
        $rating = Review::where('user_id', auth()->id())->where('product_id', $this->product->id)->first();

        $this->validate();

        if (!empty($rating)) {
            $rating->user_id = auth()->id();
            $rating->product_id = $this->product->id;
            $rating->rating = $this->rating;
            $rating->content = $this->content;
            $rating->status = 1;

            try {
                $rating->update();
                Cache::forget('recent_reviews');
                $this->alert('success', 'Your review updated successfully');
                return redirect()->route('product.show', $this->product->slug);
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            $rating = new Review();
            $rating->user_id = auth()->id();
            $rating->product_id = $this->product->id;
            $rating->rating = $this->rating;
            $rating->content = $this->content;
            $rating->status = 1;

            try {
                $rating->save();
                Cache::forget('recent_reviews');
                $this->alert('success', 'Your review added successfully');
                $this->showForm = false;
                return redirect()->route('product.show', $this->product->slug);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    public function delete($id)
    {
        $rating = Review::where('id', $id)->first();
        if ($rating && ($rating->user_id == auth()->id())) {
            $rating->delete();
            Cache::forget('recent_reviews');
            $this->alert('success', 'Your review deleted successfully');
        }
        if ($this->currentRatingId) {
            $this->currentRatingId = '';
            $this->rating  = '';
            $this->content = '';
        }
        return redirect()->route('product.show', $this->product->slug);
    }

    public function render()
    {
        return view('livewire.frontend.save-product-review-component');
    }
}
