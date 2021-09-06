<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ProductReviewComponent extends Component
{
    public $showForm = true;
    public $canRate = false;
    public $product;
    public $content;
    public $rating;
    public $checkProduct;
    public $currentRatingId;

    protected $listeners = [
        'updateRating' => 'mount',
    ];

    public function mount()
    {
        $this->checkProduct = Order::whereHas('products', function ($query) {
            $query->where('product_id', $this->product->id);
        })->where('user_id', auth()->id())->where('order_status', Order::FINISHED)->first();
        if ($this->checkProduct) {
            $this->canRate = true;
        }

        if(auth()->user()){
            $rating = Review::active()->where('user_id', auth()->id())->where('product_id', $this->product->id)->first();

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
        if (!$this->checkProduct){
            $this->alert('error', 'You must buy this item first');
            return false;
        }

        $rating = Review::where('user_id', auth()->id())->where('product_id', $this->product->id)->first();

        $this->validate();

        if (!empty($rating)) {
            $rating->user_id = auth()->id();
            $rating->product_id = $this->product->id;
            $rating->rating = $this->rating;
            $rating->content = $this->content;
            $rating->status = 1;
            $rating->update();
            Cache::forget('recent_reviews');
            $this->alert('success', 'Your review updated successfully');
            $this->showForm = false;

        } else {
            $rating = new Review();
            $rating->user_id = auth()->id();
            $rating->product_id = $this->product->id;
            $rating->rating = $this->rating;
            $rating->content = $this->content;
            $rating->status = 1;
            $rating->save();
            Cache::forget('recent_reviews');
            $this->alert('success', 'Your review added successfully');
            $this->showForm = false;
        }

        $this->emit('updateRating');
    }

    public function delete($id)
    {
        $rating = Review::where('id', $id)->first();
        if ($rating && ($rating->user_id == auth()->id())) {
            $rating->delete();
        }
        if ($this->currentRatingId) {
            $this->currentRatingId = '';
            $this->rating  = '';
            $this->content = '';
        }
        $this->emit('updateRating');
        $this->showForm = true;
        Cache::forget('recent_reviews');
        $this->alert('success', 'Your review deleted successfully');
    }

    public function render()
    {
        return view('livewire.frontend.product-review-component');
    }
}
