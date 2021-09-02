<div x-data="{ showOrder: @entangle('showOrder') }">
    <div class="d-flex">
        <h2 class="h5 text-uppercase mb-4">Orders</h2>
    </div>

    <div class="my-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="col-2"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $odr)
                    <tr wire:key="{{ $odr->id }}">
                        <td>{{ $odr->ref_id }}</td>
                        <td>{{ $odr->currency() . ' ' . $odr->total }}</td>
                        <td>{!! $odr->statusWithBadge() !!}</td>
                        <td>{{ $odr->created_at ? $odr->created_at->format('d-m-Y') : ''}}</td>
                        <td class="text-right">
                            <button type="button" wire:click="displayOrder('{{ $odr->id }}')"
                                    x-on:click="showOrder = true" class="btn btn-link text-info">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <p class="text-center">No orders found.</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($order)
            <div x-show="showOrder" x-on:click.away="showOrder = false" class="border rounded shadow p-4">
                <div class="table-responsive mb-4">
                    <table class="table">
                        <thead class="bg-light">
                        <tr>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Product</strong></th>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Price</strong></th>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Quantity</strong></th>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Total</strong></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($order->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $order->currency() . ' ' . number_format($product->price, 2) }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ $order->currency() . ' ' . number_format($product->price * $product->pivot->quantity, 2) }}</td>
                            </tr>
                        @empty
                        @endforelse

                        <tr>
                            <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
                            <td>{{ $order->currency() . ' ' . number_format($order->subtotal, 2) }}</td>
                        </tr>
                        @if(!is_null($order->discount_code))
                            <tr>
                                <td colspan="3" class="text-right"><strong>Discount (<small>{{ $order->discount_code }}</small>)</strong></td>
                                <td>{{ $order->currency() . ' ' . number_format($order->discount, 2) }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td colspan="3" class="text-right"><strong>Tax</strong></td>
                            <td>{{ $order->currency() . ' ' . number_format($order->tax, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Shipping</strong></td>
                            <td>{{ $order->currency() . ' ' . number_format($order->shipping, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total</strong></td>
                            <td>{{ $order->currency() . ' ' . number_format($order->total, 2) }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>

                <h2 class="h5 text-uppercase">Transactions</h2>
                <div class="table-responsive mb-4">
                    <table class="table">
                        <thead class="bg-light">
                        <tr>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Transaction</strong></th>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Date</strong></th>
                       {{-- <th class="border-0" scope="col"><strong class="text-small text-uppercase">Days</strong></th> --}}
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($order->transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->status() }}</td>
                                <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                           {{-- <td>{{ \Carbon\Carbon::now()->addDays(5)->diffInDays($transaction->created_at->format('Y-m-d')) }}</td>--}}
                                <td>
                                    @if ($loop->last && $transaction->transaction_status == \App\Models\OrderTransaction::FINISHED &&
                                        \Carbon\Carbon::now()->addDays(5)->diffInDays($transaction->created_at->format('Y-m-d')) != 0)
                                        <button type="button" wire:click="requestReturnOrder('{{ $order->id }}')" class="btn btn-link text-right">
                                            Return Order
                                        </button>
                                        <br>
                                        <small>you can return this order in {{ 4 - $transaction->created_at->diffInDays() }} days</small>
                                    @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
            </div>
        @endif()
    </div>
</div>
