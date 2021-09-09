<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LinkRequest;
use App\Models\Link;
use Illuminate\Support\Facades\Cache;

class LinkController extends Controller
{
    public function index()
    {
        $this->authorize('access_link');

        $links = Link::latest()->paginate(5);

        return view('backend.links.index', compact('links'));
    }

    public function create()
    {
        return view('backend.links.create');
    }

    public function store(LinkRequest $request)
    {
        $this->authorize('create_link');

        Link::create($request->validated());

        Cache::forget('admin_side_menu');

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

        Cache::forget('admin_side_menu');

        return redirect()->route('admin.links.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Link $link)
    {
        $this->authorize('delete_link');

        $link->delete();

        Cache::forget('admin_side_menu');

        return redirect()->route('admin.links.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
