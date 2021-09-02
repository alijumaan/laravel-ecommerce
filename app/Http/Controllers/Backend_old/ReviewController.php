<?php

namespace App\Http\Controllers\Backend_old;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use App\Traits\FilterTrait;

class ReviewController extends Controller
{
    use FilterTrait;

    public $review;
    public $reviewRepository;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function index()
    {
        $query = $this->review::query();

        $reviews = $this->filter($query);

        return view('backend.reviews.index', compact('reviews'));
    }

    public function edit(Review $review)
    {
        abort_if(!auth()->user()->can('edit-review'), 403, 'You did not have permission to access this page!');

        return view('backend.reviews.edit', compact('review'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->only(['name', 'email', 'status', 'review']));

        clear_cache();

        return redirect()->route('admin.reviews.index')->with(['message' => 'Review updated successfully', 'alert-type' => 'success']);
    }

    public function destroy(Review $review)
    {
        abort_if(!auth()->user()->can('delete-review'), 403, 'You did not have permission to access this page!');

        $review->delete();

        clear_cache();

        return redirect()->route('admin.reviews.index')->with(['message' => 'Review deleted successfully', 'alert-type' => 'success']);
    }
}
