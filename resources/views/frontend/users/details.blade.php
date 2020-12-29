{{--@extends('frontend.layouts.app')--}}

{{--@section('page')--}}
{{--    Details of Your Order--}}
{{--@endsection--}}

{{--@section('content')--}}

{{--    <div class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">--}}
{{--        <div class="container">--}}
{{--            <div class="breadcrumb-content text-center">--}}
{{--                <h2>Profile</h2>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{route('home')}}">home</a></li>--}}
{{--                    <li> Details </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="register-area ptb-100">--}}
{{--        <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h3 class="lead">Order Details</h3>--}}
{{--                        <span>Updated : {{$order->updated_at->diffForHumans()}}</span>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <table class="table table-striped">--}}

{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th scope="col">Order ID</th>--}}
{{--                                <th scope="col">Date</th>--}}
{{--                                <th scope="col">Quantity</th>--}}
{{--                                <th scope="col">Address</th>--}}
{{--                                <th scope="col">Price</th>--}}
{{--                                <th scope="col">Status</th>--}}
{{--                                <th scope="col">Action</th>--}}

{{--                            </tr>--}}
{{--                            </thead>--}}

{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <th scope="row">{{$order->id}}</th>--}}
{{--                                <td>{{$order->date}}</td>--}}
{{--                                <td>--}}
{{--                                    @foreach($order->OrderItems as $item)--}}
{{--                                        <table class="table">--}}
{{--                                            <tr>--}}
{{--                                                <td>{{ $item->quantity }}</td>--}}
{{--                                            </tr>--}}
{{--                                        </table>--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}
{{--                                <td>{{$order->address}}</td>--}}
{{--                                <td>--}}
{{--                                    @foreach($order->OrderItems as $item)--}}
{{--                                        <table class="table">--}}
{{--                                            <tr>--}}
{{--                                                <td>{{ $item->price }}</td>--}}
{{--                                            </tr>--}}
{{--                                        </table>--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}
{{--                                <td>{{$order->status}}</td>--}}
{{--                                <td>--}}
{{--                                    @if($order->status)--}}
{{--                                        <span class="badge badge-success">Confirmed</span>--}}
{{--                                    @else--}}
{{--                                        <span class="badge badge-warning">Pinding</span>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                            </tr>--}}

{{--                            </tbody>--}}

{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 col-md-6">--}}
{{--                <div class="table-responsive card shadow p-3">--}}
{{--                    <table class="table">--}}
{{--                        <thead>--}}
{{--                        <h3>My orders</h3><span>{{ $order->created_at }}</span>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                            <tr>--}}
{{--                                <th>Order Number</th>--}}
{{--                                <td>{{ $order->order_number }}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Product</th>--}}
{{--                                <td>--}}
{{--                                    @foreach($order->items as $product)--}}
{{--                                        <a href="{{route('dashboard').'/'.$order->id}}"> {{ $product->name }}</a>--}}
{{--                                        <br>--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Quantity</th>--}}
{{--                                <td>--}}
{{--                                    @foreach($order->OrderItems as $item)--}}
{{--                                        x {{ $item->quantity }}--}}
{{--                                        <br><br>--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Total</th>--}}
{{--                                <td>--}}
{{--                                    @foreach($order->OrderItems as $item)--}}
{{--                                        $ {{ $item->price }}--}}
{{--                                        <br>--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Address</th>--}}
{{--                                <td>{{ $order->shipping_address  }}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Status</th>--}}
{{--                                <td>--}}
{{--                                    @if($order->status == 'completed')--}}
{{--                                        <span class="badge badge-success">Completed</span>--}}
{{--                                        <br><br>--}}
{{--                                    @else--}}
{{--                                        <span class="badge badge-warning">Processing</span>--}}
{{--                                        <br><br>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    {!! $orders->links() !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 col-md-6">--}}
{{--                <div class="table-responsive card shadow p-3">--}}
{{--                    <table class="table">--}}
{{--                        <thead>--}}
{{--                        <h3>Product d</h3><span>{{ $order->created_at }}</span>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <th>Order Number</th>--}}
{{--                            <td>{{ $order->order_number }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Product</th>--}}
{{--                            <td>--}}
{{--                                @foreach($order->items as $product)--}}
{{--                                    <a href="{{route('dashboard').'/'.$order->id}}"> {{ $product->name }}</a>--}}
{{--                                    <br>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Quantity</th>--}}
{{--                            <td>--}}
{{--                                @foreach($order->OrderItems as $item)--}}
{{--                                    x {{ $item->quantity }}--}}
{{--                                    <br><br>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Total</th>--}}
{{--                            <td>--}}
{{--                                @foreach($order->OrderItems as $item)--}}
{{--                                    $ {{ $item->price }}--}}
{{--                                    <br>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Address</th>--}}
{{--                            <td>{{ $order->shipping_address  }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Status</th>--}}
{{--                            <td>--}}
{{--                                @if($order->status == 'completed')--}}
{{--                                    <span class="badge badge-success">Completed</span>--}}
{{--                                    <br><br>--}}
{{--                                @else--}}
{{--                                    <span class="badge badge-warning">Processing</span>--}}
{{--                                    <br><br>--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    --}}{{--                    {!! $orders->links() !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <br><br>--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-6">--}}
{{--                <h3 class="lead">User Details</h3>--}}
{{--                <hr>--}}
{{--                <span>Updated : {{$order->user->updated_at->diffForHumans()}}</span>--}}
{{--                <div class="body">--}}
{{--                    <table class="table table-bordered">--}}

{{--                        <tr>--}}
{{--                            <th>Name</th>--}}
{{--                            <td>{{$order->user->name}}</td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <th>Email</th>--}}
{{--                            <td>{{$order->user->email}}</td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <th>Register At</th>--}}
{{--                            <td>{{$order->user->created_at->diffForHumans()}}</td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-md-6">--}}
{{--                <h3 class="lead">Product Details</h3>--}}
{{--                <hr>--}}
{{--                <div class="body">--}}
{{--                    <table class="table table-bordered">--}}


{{--                        <tr>--}}
{{--                            <th>Product name</th>--}}
{{--                            <td>--}}
{{--                                @foreach($order->items as $product)--}}
{{--                                    <table class="table">--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $product->name }}</td>--}}
{{--                                        </tr>--}}
{{--                                    </table>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <th>Price</th>--}}
{{--                            <td>--}}
{{--                                @foreach($order->OrderItems as $item)--}}
{{--                                    <table class="table">--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $item->price }}</td>--}}
{{--                                        </tr>--}}
{{--                                    </table>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <th>Image</th>--}}
{{--                            <td>--}}
{{--                                @foreach($order->items as $product)--}}
{{--                                    <a href="{{url('uploads/'.$product->image)}}" target="_blank">--}}
{{--                                        <img src="{{asset('uploads/'.$product->image)}}" alt="{{ $product->image }}" class="thumb">--}}
{{--                                    </a>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <a href="{{route('dashboard')}}" class="btn btn-success">Back</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    </div>--}}

{{--@endsection--}}

