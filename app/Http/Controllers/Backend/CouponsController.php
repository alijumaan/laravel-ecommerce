<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Models\Coupon;
use App\Repositories\Backend\CouponRepository;

class CouponsController extends Controller
{

    public $coupon;

    public function __construct(CouponRepository $coupon)
    {
        $this->coupon = $coupon;
    }

    public function index()
    {
        $coupons = $this->coupon->index();

        return view('backend.coupons.index', compact('coupons'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-coupon'), 403, 'You did not have permission to access this page!');

        return view('backend.coupons.create');
    }

    public function store(StoreCouponRequest $request)
    {
        $this->coupon->store($request);

        return redirect()->route('admin.coupons.index')->with(['message' => 'Coupon create successfully', 'alert-type' => 'success']);
    }

    public function edit(Coupon $coupon)
    {
        abort_if(!auth()->user()->can('edit-coupon'), 403, 'You did not have permission to access this page!');

        return view('backend.coupons.edit', compact('coupon'));
    }

    public function update(StoreCouponRequest $request, Coupon $coupon)
    {
        $this->coupon->update($request, $coupon);

        return redirect()->route('admin.coupons.index')->with(['message' => 'Coupon updated successfully', 'alert-type' => 'success',]);

    }

    public function destroy(Coupon $coupon)
    {
        abort_if(!auth()->user()->can('delete-coupon'), 403, 'You did not have permission to access this page!');

        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with(['message' => 'Coupon deleted successfully', 'alert-type' => 'success']);
    }
}
