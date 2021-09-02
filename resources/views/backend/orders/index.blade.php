@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Orders
            </h6>
            <div class="ml-auto">

            </div>
        </div>

        @include('backend.orders.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Ref ID</th>
                    <th>User</th>
                    <th>Payment method</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Create date</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}">
                                {{ $order->ref_id }}
                            </a>
                        </td>
                        <td>{{ $order->user->full_name }}</td>
                        <td>{{ $order->paymentMethod->name }}</td>
                        <td>{{ $order->currency() . $order->total }}</td>
                        <td>{!! $order->statusWithBadge() !!}</td>
                        <td>{{ $order->created_at->format('Y-m-d h:i a') }}</td>
                        <td>
                            <a href="javascript:void(0);"
                               onclick="if (confirm('Are you sure to delete this record?'))
                                   {document.getElementById('delete-order-{{ $order->id }}').submit();} else {return false;}"
                               class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order) }}"
                                  method="POST"
                                  id="delete-order-{{ $order->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">No orders found.</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="float-right">
                            {!! $orders->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
