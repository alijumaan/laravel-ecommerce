@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-2">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0 font-weight-bold text-success">Orders</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead >
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)

                            <tr>
                                <th>{{$order->id}}</th>
                                <th>{{$order->user->name}}</th>
                                <th>
                                    @foreach($order->items as $item)
                                        <p>{{$item->name}} :</p>
                                    @endforeach
                                </th>
                                <th>
                                    @foreach($order->OrderItems as $item)
                                        <p>{{$item->quantity}}</p>
                                    @endforeach
                                </th>
                                <th>
                                    @if($order->status)
                                        <span class="badge badge-success">Confirmed</span>
                                    @else
                                        <span class="badge badge-warning">Pinding</span>
                                    @endif
                                </th>
                                <th>
                                    @if($order->status)
                                        {{ link_to_route('order.pending', 'Pending', $order->id, ['class' => 'btn btn-warning btn-sm']) }}
                                    @else
                                        {{ link_to_route('order.confirm', 'Confirm', $order->id, ['class' => 'btn btn-outline-success btn-sm']) }}
                                    @endif
                                    {{ link_to_route('admin.orders.show', 'Details', $order->id, ['class' => 'btn btn-outline-info btn-sm']) }}
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
