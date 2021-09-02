@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $coupon->code }}
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-primary">
                    <span class="text">Back to coupons</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Value</th>
                    <th>Created at</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->value }}</td>
                    <td>{{ $coupon->created_at ? $coupon->created_at->format('Y-m-d') : '' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
