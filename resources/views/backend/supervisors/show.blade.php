@extends('backend.layouts.app')

@section('content')

    <div class="card shadow-sm mb-2">
        <div class="card-header d-flex py-3">
            <h4 class="m-0 font-weight-bold text-success">User ( {{ $supervisor->name }} )</h4>
            <div class="ml-auto">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-success">
                        <span class="icon text-success-50">
                            <i class="fa fa-home"></i>
                        </span>
                    <span class="text">Users</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $supervisor->name }} ({{ $supervisor->username }})</td>
                    <th>Email</th>
                    <td>{{ $supervisor->email }}</td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td>{{ $supervisor->mobile }}</td>
                    <th>Status</th>
                    <td>{{ $supervisor->status }}</td>
                </tr>
                <tr>
                    <th>Created date</th>
                    <td>{{ $supervisor->created_at->format('d-m-Y h:i a') }}</td>
                    <th>Orders Count</th>
                    <td>{{ $supervisor->orders_count }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm mb-2">
        <div class="card-header d-flex py-3">
            <h4 class="m-0 font-weight-bold text-success">Orders</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Order number</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Product Price</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($supervisor->orders as $order)
                    <tr>
                        <td>{{$order->order_number}}</td>
                        <td>
                            @forelse($order->items as $product)
                                <p>{{ $product->name }}</p>
                            @empty
                            @endforelse
                        </td>
                        <td>
                            @foreach($order->OrderItems as $item)
                                <p>x{{ $item->quantity }}</p>
                            @endforeach
                        </td>
                        <td>
                            @forelse($order->OrderItems as $item)
                                <p>${{ $item->price }}</p>
                            @empty
                            @endforelse
                        </td>
                        <td>
                            @if($order->status)
                                <span class="badge badge-success">Confirmed</span>
                            @else
                                <span class="badge badge-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="5" class="text-center">No orders found.</th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm mb-2">
        <div class="card-header d-flex py-3">
            <h4 class="m-0 font-weight-bold text-success">Reviews</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-content table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>review</th>
                    <th>Status</th>
                    <th>Create at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($supervisor->reviews as $review)
                    <tr>
                        <td><img src="{{ get_gravatar($review->email, 50) }}" alt="" class="img-circle"></td>
                        <td>{{ $review->name }}</td>
                        <td>{!! $review->review !!}</td>
                        <td>{{ $review->status() }}</td>
                        <td>{{ $review->created_at->format('d-m-Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-toggle">
                                <a href="{{ route('admin.reviews.edit', $review->id) }}" title="Edit" class="btn-primary btn btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);" onclick="if (confirm('Are You sure want to Delete?'))
                                    { document.getElementById('review-delete-{{ $review->id }}').submit(); } else { return false; }"
                                   title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                </a>
                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="post" id="review-delete-{{ $review->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="9" class="text-center">No reviews found.</th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection






















