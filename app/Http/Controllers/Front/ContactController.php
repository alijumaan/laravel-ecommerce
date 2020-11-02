<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact.index');
    }

    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email',
            'mobile'   => 'nullable|numeric',
            'title'    => 'required|min:5',
            'message'  => 'required|min:10',
        ]);


        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $userId = auth()->check() ?  auth()->id() : null;

        $data['name']     = $request['name'];
        $data['email']    = $request['email'];
        $data['mobile']   = $request['mobile'];
        $data['title']    = $request['title'];
        $data['message']  = $request['message'];
        $data['user_id']  = $userId;

        Contact::create($data);

        return redirect()->route('home')->with([
            'message' => 'Thank you for contact us ',
            'alert-type' => 'success'
        ]);

    }
}
