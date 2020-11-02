@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-2">
                <div class="card-header d-flex py-3">
                    <div class="">
                        <h4 class="m-0 font-weight-bold text-success">Order Details</h4>
                        <span>Updated : {{ $order->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="ml-auto">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-success">
                        <span class="icon text-success-50">
                            <i class="fa fa-home"></i>
                        </span>
                            <span class="text">All product</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">

                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>

                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <th scope="row">{{$order->id}}</th>
                            <td>{{$order->created_at}}</td>
                            @forelse($order->orderItems as $item)
                                <td>{{$item->quantity}}</td>
                            @empty
                                <td>not found.</td>
                            @endforelse
                            @forelse($order->items as $item)
                                 <td>{{$item->price}}</td>
                            @empty
                                <td>not found</td>
                            @endforelse
                            <td>{{$order->status}}</td>
                            <td>
                                @if($order->status)
                                    <span class="badge badge-success">Confirmed</span>
                                @else
                                    <span class="badge badge-warning">Pinding</span>
                                @endif
                            </td>
                        </tr>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="lead">User Details</h3>
                    <span>Updated : {{$order->user->updated_at->diffForHumans()}}</span>
                </div>
                <div class="card-body">
                    <table class="table table-striped">

                        <tr>
                            <th>ID</th>
                            <td>{{$order->user->id}}</td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td>{{$order->user->name}}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{$order->user->email}}</td>
                        </tr>

                        <tr>
                            <th>Register At</th>
                            <td>{{$order->user->created_at->diffForHumans()}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="lead">Product Details</h3>
                    <span>Updated : {{$order->user->updated_at->diffForHumans()}}</span>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>
                                    @forelse($order->items as $product)
                                        <p>{{ $product->name }}</p>
                                    @empty
                                        <p>not found.</p>
                                    @endforelse
                                </td>
                                <td>
                                    @forelse($order->OrderItems as $item)
                                        <p>{{ $item->price }}</p>
                                    @empty
                                        <p>not found.</p>
                                    @endforelse
                                </td>
                                <td>

                                    @forelse($order->OrderItems as $item)
                                            <p>{{ $item->quantity }}</p>
                                    @empty
                                        <p>not found.</p>
                                    @endforelse
                                </td>
                                <td>
                                    @forelse($order->items as $item)
                                    @if($product->media->count() > 0)
                                        <a href="{{url('uploads/products/'.$item->media[0]->file_name)}}" target="_blank">
                                            <img style="width: 150px" src="{{asset('uploads/products/'.$item->media[0]->file_name)}}" alt="{{ $item->name }}" class="thumb">
                                        </a>
                                    @endif
                                    @empty
                                        <p>not found.</p>
                                    @endforelse
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
