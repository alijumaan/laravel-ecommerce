<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{

    public function index()
    {
        return view('frontend.contact.index');
    }

    public function store(StoreContactRequest $request)
    {
        Contact::create($request->validated() + [
            'user_id' => auth()->check() ? auth()->id() : null
        ]);

        return redirect()->route('home')
            ->with(['message' => 'Thank you for contact us ', 'alert-type' => 'success']);
    }
}
