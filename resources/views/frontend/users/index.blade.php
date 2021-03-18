@extends('frontend.layouts.app')

@section('content')

    <div class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>Dashboard</h2>
                <ul>
                    <li><a href="{{route('home')}}">home</a></li>
                    <li> My profile</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5 pb-5 ">
        <div class="row">
            <div class="col-lg-2" style="float: left">
                @include('frontend.users._sidebar')
            </div>
            <div class="col-lg-10" style="float: left">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="table-responsive card shadow p-3">

                            <table class="table">
                                <thead>
                                <h3 class="text-success">User Details</h3>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>Image</th>
                                    <td><img class="avatar" src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                             alt="{{ auth()->user()->name }} has not image"/></td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{auth()->user()->name}}</td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td>{{auth()->user()->username}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{auth()->user()->email}}</td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    @if(auth()->user()->mobile)
                                        <td>{{auth()->user()->mobile}}</td>
                                    @else
                                        <td><small>No phone found</small></td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Bio</th>
                                    @if(auth()->user()->bio)
                                        <td>{{auth()->user()->bio}}</td>
                                    @else
                                        <td><small>No bio found</small></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center bg-success">
                                        <a href="{{route('frontend.users.edit') }}"><i class="fa fa-edit text-white">
                                                Update</i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="table-responsive card shadow p-3">
                            <table class="table">
                                <thead>
                                <h3>My orders</h3>
                                </thead>
                                <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <th>Date</th>
                                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Number</th>
                                        <td>{{ $order->order_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <td>
                                            @foreach($order->items as $product)
                                                <a href="{{route('frontend.products.show', $product->slug) }}"> {{ $product->name }}</a>
                                                <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td>
                                            @foreach($order->orderItems as $item)
                                                <span>x {{ $item->quantity }}</span><br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>
                                            @foreach($order->orderItems as $item)
                                                <span>$ {{ $item->price }}</span>
                                                <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($order->status == 'completed')
                                                <span class="badge badge-success">Completed</span>
                                                <br><br>
                                            @else
                                                <span class="badge badge-warning">Processing</span>
                                                <br><br>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No orders found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            {!! $orders->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection































