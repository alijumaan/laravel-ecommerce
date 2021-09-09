<?php

namespace App\Http\Controllers\Frontend\Payment;

use App\Http\Controllers\Controller;
use App\Services\TapService;
use Illuminate\Http\Request;

class TapController extends Controller
{
    public function chargeRequest()
    {
        $user = auth()->user();
        $total = getNumbersOfCart()->get('total');

        return redirect((new TapService())->getChargeRequest(
            $total,
            $user->full_name,
            $user->email,
            $user->phone
        ));
    }

    public function chargeUpdate(Request $request)
    {
        return (new TapService())->validateRequest($request, request()->tap_id);
    }
}
