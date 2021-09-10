<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ReviewRequest;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function index(): View
    {
        $this->authorize('access_review');

        $reviews = Review::with('product', 'user')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);
        return view('backend.reviews.index', compact('reviews'));
    }

    public function show(Review $review): View
    {
        $this->authorize('show_review');

        return view('backend.reviews.show', compact('review'));
    }

    public function edit(Review $review): View
    {
        $this->authorize('edit_review');

        return view('backend.reviews.edit', compact('review'));
    }

    public function update(ReviewRequest $request, Review $review): RedirectResponse
    {
        $this->authorize('edit_review');

        $review->update($request->validated());

        return redirect()->route('admin.reviews.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Review $review): RedirectResponse
    {
        $this->authorize('delete_review');

        $review->delete();

        return redirect()->route('admin.reviews.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
