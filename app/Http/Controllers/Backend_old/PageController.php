<?php

namespace App\Http\Controllers\Backend_old;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Models\Page;

class PageController extends Controller
{

    public $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function index()
    {
        $pages = $this->page->all();

        return view('backend.pages.index', compact('pages'));
    }

    public function show(Page $page)
    {
        return view('backend.pages.show', compact('page'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-page'), 403, 'You did not have permission to access this page!');

        return view('backend.pages.create');
    }

    public function store(StorePageRequest $request)
    {
        $this->page->create($request->validated());

        return redirect()->back()->with(['message' => 'Page added successfully', 'alert-type' => 'success',]);


    }

    public function edit(Page $page)
    {
        abort_if(!auth()->user()->can('edit-page'), 403, 'You have not permission to access this page!');

        return view('backend.pages.edit', compact('page'));
    }

    public function update(StorePageRequest $request, Page $page)
    {
        $page->update($request->validated());

        return redirect()->back()->with(['message' => 'Page updated successfully', 'alert-type' => 'success',]);
    }

    public function destroy(Page $page)
    {
        abort_if(!auth()->user()->can('delete-page'), 403, 'You have not permission to access this page!');

        $page->delete();

        return redirect()->back()->with(['message' => 'Page deleted successfully', 'alert-type' => 'success',]);

    }

}
