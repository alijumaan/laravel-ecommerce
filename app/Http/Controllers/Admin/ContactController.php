<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{

    public function __construct()
    {
        if (\auth()->check()) {
            $this->middleware('auth');
        } else {
            return view('admin.index');
        }
    }

    public function index()
    {
        if (!\auth()->user()->ability('admin', 'manage_contact_us, show_contact_us')) {
            return redirect('admin/index');
        }

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

        return view('admin.contacts.index', compact(  'messages'));
    }

    public function show($id)
    {
        if (!\auth()->user()->ability('admin', 'display_contact_us')) {
            return redirect('admin/index');
        }

        $message = Contact::whereId($id)->first();
        if ($message && $message->status == 0) {
            $message->status = 1;
            $message->save();
        }

        return view('admin.contacts.show', compact('message'));
    }

    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_contact_us')) {
            return redirect('admin/index');
        }

        $message = Contact::whereId($id)->first();
        if($message) {
            $message->delete();

            return redirect()->route('admin.contacts.index')->with([
                'message' => 'Message deleted successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.contacts.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }
}
