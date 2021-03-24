<?php

namespace App\Repositories\Backend;

class ReviewRepository
{
    public function update(array $request, $review)
    {
        $review->update($request);

        clear_cache();
   }

    public function delete($review)
    {
        abort_if(!auth()->user()->can('delete-review'), 403, 'You did not have permission to access this page!');

        $review->delete();

        clear_cache();
    }
}
