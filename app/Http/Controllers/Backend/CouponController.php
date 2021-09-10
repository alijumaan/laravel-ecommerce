<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CouponRequest;
use App\Models\Coupon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CouponController extends Controller
{
    public function index(): View
    {
        $this->authorize('access_coupon');

        $coupons = Coupon::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);

        return view('backend.coupons.index', compact('coupons'));
    }

    public function create(): View
    {
        $this->authorize('create_coupon');

        return view('backend.coupons.create');
    }

    public function store(CouponRequest $request): RedirectResponse
    {
        $this->authorize('create_coupon');

        Coupon::create($request->validated());

        return redirect()->route('admin.coupons.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(Coupon $coupon): View
    {
        $this->authorize('show_coupon');

        return view('backend.coupons.show', compact('coupon'));
    }

    public function edit(Coupon $coupon): View
    {
        $this->authorize('edit_coupon');

        return view('backend.coupons.edit', compact('coupon'));
    }

    public function update(CouponRequest $request, Coupon $coupon): RedirectResponse
    {
        $this->authorize('edit_coupon');

        $coupon->update($request->validated());

        return redirect()->route('admin.coupons.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Coupon $coupon): RedirectResponse
    {
        $this->authorize('delete_coupon');

        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
