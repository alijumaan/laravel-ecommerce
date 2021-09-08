<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LinkRequest;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
        $this->authorize('access_link');
        $links = Link::paginate(10);
        return view('backend.links.index', compact('links'));
    }

    public function store(LinkRequest $request)
    {
        $this->authorize('create_link');

        Link::create($request->validated());

        return redirect()->route('admin.links.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function edit(Link $link)
    {
        $this->authorize('edit_link');
        return view('backend.links.edit', compact('link'));
    }

    public function update(LinkRequest $request, Link $link)
    {
        $this->authorize('edit_link');

        $link->update($request->validated());

        return redirect()->route('admin.links.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Link $link)
    {
        $this->authorize('delete_link');

        $link->delete();

        return redirect()->route('admin.links.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
