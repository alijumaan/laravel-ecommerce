<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Traits\FilterTrait;

class ContactController extends Controller
{
    use FilterTrait;

    public $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function index()
    {
        $query = $this->contact::query();
        $messages = $this->filter($query);

        return view('backend.contacts.index', compact('messages'));
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

        $contact->delete();

        return redirect()->route('admin.contacts.index')->with(['message' => 'Message deleted successfully', 'alert-type' => 'success']);
    }
}
