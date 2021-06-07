<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\OrderService;

class OrderController extends Controller
{

    public function chargeRequest()
    {
        $user = auth()->user();

        $total = \Cart::session(auth()->id())->getTotal();

        return redirect((new OrderService())->getChargeRequest($total, $user->name, $user->email, $user->phone));
    }

    public function chargeUpdate()
    {
        return (new OrderService())->validateRequest(request()->tap_id);
    }

}
