<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\OrderCompleted;
use App\Models\Order;
use App\Repositories\Frontend\OrderRepository;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->middleware('auth');
        return $this->orderRepository = $orderRepository;
    }

    public function chargeRequest()
    {
        $user = auth()->user();
        $total = \Cart::session(auth()->id())->getTotal();

        return redirect($this->orderRepository->getChargeRequest($total, $user->name, $user->email, $user->phone));
    }

    public function chargeUpdate()
    {
        return $this->orderRepository->validateRequest(request()->tap_id);
    }

}
