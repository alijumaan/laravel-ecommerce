<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {

        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sortBy = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $orderBy = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limitBy = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';

        $messages = Contact::query();
        if ($keyword != null) {
            $messages = $messages->search($keyword);
        }

        if ($status != null) {
            $messages = $messages->whereStatus($status);
        }

        $messages = $messages->orderBy($sortBy, $orderBy);
        $messages = $messages->paginate($limitBy);

        return view('backend.contacts.index', compact(  'messages'));
    }

    public function show(Contact $contact)
    {
        abort_if(!auth()->user()->can('show-message'), 403, 'You did not have permission to access this page!');
        if ($contact && $contact->status == 0) {
            $contact->status = 1;
            $contact->save();
        }
        return view('backend.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        abort_if(!auth()->user()->can('delete-message'), 403, 'You did not have permission to access this page!');
        if($contact) {
            $contact->delete();
            return redirect()->route('admin.contacts.index')->with(['message' => 'Message deleted successfully', 'alert-type' => 'success']);
        }
        return redirect()->route('admin.contacts.index')->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }
}
