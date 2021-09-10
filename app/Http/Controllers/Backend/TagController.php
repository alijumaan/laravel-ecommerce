<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TagRequest;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TagController extends Controller
{
    public function index(): View
    {
        $this->authorize('access_tag');
        $tags = Tag::with('products')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);
        return view('backend.tags.index', compact('tags'));
    }

    public function create(): View
    {
        $this->authorize('create_tag');
        return view('backend.tags.create');
    }

    public function store(TagRequest $request): RedirectResponse
    {
        $this->authorize('create_tag');

        Tag::create($request->validated());

        return redirect()->route('admin.tags.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(Tag $tag): View
    {
        $this->authorize('show_tag');
        return view('backend.tags.show', compact('tag'));
    }

    public function edit(Tag $tag): View
    {
        $this->authorize('edit_tag');
        return view('backend.tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag): RedirectResponse
    {
        $this->authorize('edit_tag');

        $tag->update($request->validated());

        return redirect()->route('admin.tags.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $this->authorize('delete_tag');

        $tag->delete();

        return redirect()->route('admin.tags.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
