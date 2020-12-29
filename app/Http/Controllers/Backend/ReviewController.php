<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Category;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ReviewController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $productId = (isset(\request()->product_id) && \request()->product_id != '') ? \request()->product_id : null;
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sortBy = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $orderBy = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limitBy = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';

        $reviews = Review::query();
        if ($keyword != null) {
            $reviews = $reviews->search($keyword);
        }
        if ($productId != null) {
            $reviews = $reviews->whereProductId($productId);
        }
        if ($status != null) {
            $reviews = $reviews->whereStatus($status);
        }

        $reviews = $reviews->orderBy($sortBy, $orderBy);
        $reviews = $reviews->paginate($limitBy);

        $products = Product::orderBy('id', 'desc')->pluck('name', 'id');
        return view('backend.reviews.index', compact( 'reviews', 'products'));
    }

    public function edit(Review $review)
    {
        abort_if(!auth()->user()->can('edit-review'), 403, 'You did not have permission to access this page!');
        return view('backend.reviews.edit', compact('review'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        if($review) {
            $data['name']         = $request->name;
            $data['email']        = $request->email;
            $data['status']       = $request->status;
            $data['review']      = $request->review;
            $review->update($data);
            clear_cache();
            return redirect()->route('admin.reviews.index')->with(['message' => 'Review updated successfully', 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }

    public function destroy(Review $review)
    {
        abort_if(!auth()->user()->can('delete-review'), 403, 'You did not have permission to access this page!');
        $review->delete();
        clear_cache();
        return redirect()->route('admin.reviews.index')->with(['message' => 'Review deleted successfully', 'alert-type' => 'success']);
    }
}
