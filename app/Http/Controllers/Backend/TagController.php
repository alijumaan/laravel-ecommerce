<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;
use App\Traits\FilterTrait;

class TagController extends Controller
{
    use FilterTrait;

    public $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function index()
    {
        $query = $this->tag::withCount('products');
        $tags = $this->filter($query);

        return view('backend.tags.index', compact( 'tags'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-tag'), 403, 'You did not have permission to access this page!');
        return view('backend.tags.create');
    }

    public function store(StoreTagRequest $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();
        clear_cache();

        return redirect()->route('admin.tags.index')->with(['message' => 'Tag create successfully', 'alert-type' => 'success']);
    }

    public function edit(Tag $tag)
    {
        abort_if(!auth()->user()->can('edit-tag'), 403, 'You did not have permission to access this page!');

        return view('backend.tags.edit', compact('tag'));
    }

    public function update(StoreTagRequest $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();
        clear_cache();

        return redirect()->route('admin.tags.index')->with(['message' => 'Tag updated successfully', 'alert-type' => 'success']);
    }

    public function destroy(Tag $tag)
    {
        abort_if(!auth()->user()->can('delete-tag'), 403, 'You did not have permission to access this page!');
        $tag->delete();
        clear_cache();

        return redirect()->route('admin.tags.index')->with(['message' => 'Tag deleted successfully', 'alert-type' => 'success']);
    }
}
