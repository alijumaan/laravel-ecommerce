<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponsController extends Controller
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
        if (!\auth()->user()->ability('admin', 'manage_coupons, show_coupons')) {
            return redirect('admin/index');
        }

        $coupons = Coupon::orderBy('id', 'desc')->paginate(5);
        return view('admin.coupons.index', compact( 'coupons'));
    }

    public function create()
    {
        if (!\auth()->user()->ability('admin', 'create_coupons')) {
            return redirect('admin/index');
        }
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'create_coupons')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'code'         => 'required',
            'type'         => 'required',
            'value'        => 'required',
            'description'  => 'nullable|max:128',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['name']         = $request->name;
        $data['code']         = $request->code;
        $data['type']         = $request->type;
        $data['value']        = $request->value;
        $data['description']  = $request->description;

        $coupon = Coupon::create($data);

        if ($coupon) {
            return redirect()->route('admin.coupons.index')->with([
                'message' => 'Coupon create successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.coupons.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);

    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_coupons')) {
            return redirect('admin/index');
        }

        $coupon = Coupon::whereId($id)->orderBy('id', 'desc')->first();
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_coupons')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'code'         => 'required',
            'type'         => 'required',
            'value'        => 'required',
            'description'  => 'nullable|max:128',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $coupon = Coupon::whereId($id)->first();

        if($coupon) {
            $data['name']         = $request->name;
            $data['code']         = $request->code;
            $data['type']         = $request->type;
            $data['value']        = $request->value;
            $data['description']  = $request->description;

            $coupon->update($data);

            return redirect()->route('admin.coupons.index')->with([
                'message' => 'Coupon updated successfully',
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
        if (!\auth()->user()->ability('admin', 'delete_coupons')) {
            return redirect('admin/index');
        }

        $coupon = Coupon::whereId($id)->first();
        if($coupon) {
            $coupon->delete();
            return redirect()->route('admin.coupons.index')->with([
                'message' => 'Coupon deleted successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.coupons.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

}
