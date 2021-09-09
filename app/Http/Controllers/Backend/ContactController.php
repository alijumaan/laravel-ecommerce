<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $this->authorize('access_contact');

        $contacts = Contact::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);

        return view('backend.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $this->authorize('show_contact');

        return view('backend.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete_contact');

        $contact->delete();

        return redirect()->route('admin.contacts.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
