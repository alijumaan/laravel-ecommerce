<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
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
        if (!\auth()->user()->ability('admin', 'manage_tags, show_tags')) {
            return redirect('admin/index');
        }

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

        return view('admin.tags.index', compact( 'tags'));
    }

    public function create()
    {
        if (!\auth()->user()->ability('admin', 'create_tags')) {
            return redirect('admin/index');
        }
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        try {

            if (!\auth()->user()->ability('admin', 'create_tags')) {
                return redirect('admin/index');
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['name'] = $request->name;

            $tag = Tag::create($data);

            clear_cache();

            if ($tag) {
                return redirect()->route('admin.tags.index')->with([
                    'message' => 'Tag create successfully',
                    'alert-type' => 'success',
                ]);
            }

        } catch (\Exception $exception) {
            return redirect()->route('admin.tags.index')->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger',
            ]);
        }
    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_tags')) {
            return redirect('admin/index');
        }

        $tag = Tag::whereId($id)->first();
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_tags')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tag = Tag::whereId($id)->first();

        if($tag) {
            $data['name'] = $request->name;

            $tag->update($data);

            clear_cache();

            return redirect()->route('admin.tags.index')->with([
                'message' => 'Tag updated successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_tags')) {
            return redirect('admin/index');
        }

        $tag = Tag::whereId($id)->first();
        if($tag) {
            $tag->delete();

            clear_cache();

            return redirect()->route('admin.tags.index')->with([
                'message' => 'Tag deleted successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.tags.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }
}
