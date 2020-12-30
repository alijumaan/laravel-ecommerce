<?php

namespace App\Repositories\Backend;

class ReviewRepository
{
    public function update($request, $review)
    {
        $data['name']         = $request->name;
        $data['email']        = $request->email;
        $data['status']       = $request->status;
        $data['review']      = $request->review;

        $review->update($data);

        clear_cache();
   }

    public function delete($review)
    {
        abort_if(!auth()->user()->can('delete-review'), 403, 'You did not have permission to access this page!');

        $review->delete();

        clear_cache();
    }
}
