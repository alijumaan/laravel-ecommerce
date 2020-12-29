<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {

        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $sortBy = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $orderBy = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limitBy = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';

        $tags = Tag::withCount('products');
        if ($keyword != null) {
            $tags = $tags->search($keyword);
        }

        $tags = $tags->orderBy($sortBy, $orderBy);
        $tags = $tags->paginate($limitBy);

        return view('backend.tags.index', compact( 'tags'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-tag'), 403, 'You did not have permission to access this page!');
        return view('backend.tags.create');
    }

    public function store(StoreTagRequest $request, Tag $tag)
    {
        try {
            $tag->name = $request->name;
            $tag->save();
            clear_cache();
            if ($tag) {
                return redirect()->route('admin.tags.index')->with(['message' => 'Tag create successfully', 'alert-type' => 'success']);
            }
        } catch (\Exception $exception) {
            return redirect()->route('admin.tags.index')->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
        }
    }

    public function edit(Tag $tag)
    {
        abort_if(!auth()->user()->can('edit-tag'), 403, 'You did not have permission to access this page!');
        return view('backend.tags.edit', compact('tag'));
    }

    public function update(StoreTagRequest $request, Tag $tag)
    {
        if($tag) {
            $tag->name = $request->name;
            $tag->save();
            clear_cache();
            return redirect()->route('admin.tags.index')->with(['message' => 'Tag updated successfully', 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }

    public function destroy(Tag $tag)
    {
        abort_if(!auth()->user()->can('delete-tag'), 403, 'You did not have permission to access this page!');
        if($tag) {
            $tag->delete();
            clear_cache();
            return redirect()->route('admin.tags.index')->with(['message' => 'Tag deleted successfully', 'alert-type' => 'success']);
        }
        return redirect()->route('admin.tags.index')->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }
}
