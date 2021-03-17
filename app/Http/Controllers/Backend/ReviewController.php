<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use App\Repositories\Backend\ReviewRepository;
use App\Traits\FilterTrait;

class ReviewController extends Controller
{
    use FilterTrait;

    public $review;
    public $reviewRepository;

    public function __construct(Review $review, ReviewRepository $reviewRepository)
    {
        $this->review = $review;
        $this->reviewRepository = $reviewRepository;
    }

    public function index()
    {
        $query = $this->review::query();

        $reviews = $this->filter($query);

        return view('backend.reviews.index', compact( 'reviews'));
    }

    public function edit(Review $review)
    {
        abort_if(!auth()->user()->can('edit-review'), 403, 'You did not have permission to access this page!');

        return view('backend.reviews.edit', compact('review'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $this->reviewRepository->update($request, $review);

        return redirect()->route('admin.reviews.index')->with(['message' => 'Review updated successfully', 'alert-type' => 'success']);
    }

    public function destroy(Review $review)
    {
        $this->reviewRepository->delete($review);

        return redirect()->route('admin.reviews.index')->with(['message' => 'Review deleted successfully', 'alert-type' => 'success']);
    }
}
