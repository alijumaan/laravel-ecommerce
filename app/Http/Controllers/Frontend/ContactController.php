<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{

    public function index()
    {
        return view('frontend.contact.index');
    }

    public function store(StoreContactRequest $request)
    {
        $userId = auth()->check() ?  auth()->id() : null;
        $data['name']     = $request['name'];
        $data['email']    = $request['email'];
        $data['mobile']   = $request['mobile'];
        $data['title']    = $request['title'];
        $data['message']  = $request['message'];
        $data['user_id']  = $userId;
        Contact::create($data);

        return redirect()->route('home')->with(['message' => 'Thank you for contact us ', 'alert-type' => 'success']);

    }
}
