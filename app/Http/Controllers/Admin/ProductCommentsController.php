<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductCommentsController extends Controller
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
        if (!\auth()->user()->ability('admin', 'manage_product_comments, show_product_comments')) {
            return redirect('admin/index');
        }

        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $productId = (isset(\request()->product_id) && \request()->product_id != '') ? \request()->product_id : null;
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sortBy = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $orderBy = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limitBy = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';

        $comments = Comment::query();
        if ($keyword != null) {
            $comments = $comments->search($keyword);
        }
        if ($productId != null) {
            $comments = $comments->whereProductId($productId);
        }
        if ($status != null) {
            $comments = $comments->whereStatus($status);
        }

        $comments = $comments->orderBy($sortBy, $orderBy);
        $comments = $comments->paginate($limitBy);

        $products = Product::orderBy('id', 'desc')->pluck('name', 'id');
        return view('admin.product_comments.index', compact( 'comments', 'products'));
    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_product_comments')) {
            return redirect('admin/index');
        }

        $comment = Comment::whereId($id)->first();
        return view('admin.product_comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_product_comments')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'email'        => 'required|email',
            'url'          => 'nullable|url',
            'status'       => 'required',
            'comment'      => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $comment = Comment::whereId($id)->first();

        if($comment) {
            $data['name']         = $request->name;
            $data['email']        = $request->email;
            $data['status']       = $request->status;
            $data['comment']      = $request->comment;

            $comment->update($data);

            clear_cache();

            // Redirect
            return redirect()->route('admin.product-comments.index')->with([
                'message' => 'Comment updated successfully',
                'alert-type' => 'success',
            ]);

        }

        // Redirect
        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);

    }

    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_product_comments')) {
            return redirect('admin/index');
        }

        $comment = Comment::whereId($id)->first();

        $comment->delete();

        Cache::forget('recent_comments');

        return redirect()->route('admin.product-comments.index')->with([
            'message' => 'Comment deleted successfully',
            'alert-type' => 'success',
        ]);
    }
}
