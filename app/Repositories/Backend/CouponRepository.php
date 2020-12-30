<?php

namespace App\Repositories\Backend;

use App\Models\Coupon;

class CouponRepository
{
    public $coupon;

    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function index()
    {
        return $this->coupon::orderBy('id', 'desc')->paginate(5);
    }

    public function store($request)
    {
        $data['name']         = $request->name;
        $data['code']         = $request->code;
        $data['type']         = $request->type;
        $data['value']        = $request->value;
        $data['description']  = $request->description;
        $this->coupon::create($data);
    }

    public function update($request, $coupon)
    {
        $coupon->name         = $request->name;
        $coupon->code         = $request->code;
        $coupon->type         = $request->type;
        $coupon->value        = $request->value;
        $coupon->description  = $request->description;
        $coupon->save();
    }
}
