<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Models\Coupon;

class CouponsController extends Controller
{

    public $coupon;

    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function index()
    {
        $coupons = $this->coupon::orderBy('id', 'desc')->paginate(5);
        return view('backend.coupons.index', compact( 'coupons'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-coupon'), 403, 'You did not have permission to access this page!');
        return view('backend.coupons.create');
    }

    public function store(StoreCouponRequest $request)
    {
        $data['name']         = $request->name;
        $data['code']         = $request->code;
        $data['type']         = $request->type;
        $data['value']        = $request->value;
        $data['description']  = $request->description;
        $coupon = $this->coupon::create($data);
        if ($coupon) {
            return redirect()->route('admin.coupons.index')->with(['message' => 'Coupon create successfully', 'alert-type' => 'success']);
        }
        return redirect()->route('admin.coupons.index')->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }

    public function edit(Coupon $coupon)
    {
        abort_if(!auth()->user()->can('edit-coupon'), 403, 'You did not have permission to access this page!');
        return view('backend.coupons.edit', compact('coupon'));
    }

    public function update(StoreCouponRequest $request, Coupon $coupon)
    {
        if($coupon) {
            $coupon->name         = $request->name;
            $coupon->code         = $request->code;
            $coupon->type         = $request->type;
            $coupon->value        = $request->value;
            $coupon->description  = $request->description;
            $coupon->save();

            return redirect()->route('admin.coupons.index')->with(['message' => 'Coupon updated successfully', 'alert-type' => 'success',]);
        }
        return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger',]);
    }

    public function destroy(Coupon $coupon)
    {
        abort_if(!auth()->user()->can('delete-coupon'), 403, 'You did not have permission to access this page!');
        if($coupon) {
            $coupon->delete();
            return redirect()->route('admin.coupons.index')->with(['message' => 'Coupon deleted successfully', 'alert-type' => 'success']);
        }
        return redirect()->route('admin.coupons.index')->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }
}
