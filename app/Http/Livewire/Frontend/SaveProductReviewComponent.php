<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class SaveProductReviewComponent extends Component
{
    public $hideForm = false;
    public $product;
    public $content;
    public $rating;
    public $currentId;

    public function mount()
    {
        if(auth()->user()){
            $rating = Review::where('user_id', auth()->id())->where('product_id', $this->product->id)->first();
            if (!empty($rating)) {
                $this->rating  = $rating->rating;
                $this->content = $rating->content;
                $this->currentId = $rating->id;
            }
        }
    }

    public function rules()
    {
        return [
            'rating' => ['required', 'string'],
            'content' => ['required', 'string']
        ];
    }

    public function StoreReview(Request $request, $productId)
    {
        $this->validate();

        $data['user_id']          = auth()->id();
        $data['product_id']       = $productId;
        $data['rating']           = $this->rating;
        $data['status']           = 1;
        $data['content']          = $this->content;
        $data['ip_address']       = $request->ip();

        $review = $this->product->reviews()->create($data);

        if ($review) {
            Cache::forget('recent_reviews');
            $this->content = '';
            $this->alert('success', 'Your review added successfully');
            //return redirect()->route('product.show', $this->product->slug);
        }

        //return redirect()->back()->with(['message' => 'Review added successfully', 'alert-type' => 'success']);
    }

    public function delete($id)
    {
        $rating = Review::where('id', $id)->first();
        if ($rating && ($rating->user_id == auth()->id())) {
            $rating->delete();
        }
        if ($this->currentId) {
            $this->currentId = '';
            $this->rating  = '';
            $this->content = '';
        }
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
            } catch (\Throwable $th) {
                throw $th;
            }
            session()->flash('message', 'Success!');
        } else {
            $rating = new Review();
            $rating->user_id = auth()->id();
            $rating->product_id = $this->product->id;
            $rating->rating = $this->rating;
            $rating->content = $this->content;
            $rating->status = 1;
            try {
                $rating->save();
            } catch (\Throwable $th) {
                throw $th;
            }
            $this->hideForm = true;
        }
    }

    public function render()
    {
        return view('livewire.frontend.save-product-review-component');
    }
}
