@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="header">Edit Coupon ({{ $coupon->name }})</h4>
        </div>

        <div class="card-body">
            {!! Form::model($coupon, ['route' => ['admin.coupons.update', $coupon->id], 'method' => 'patch']) !!}

            @include('backend.coupons._fields')

            <div class="form-group pt-4">
                {!! Form::submit('Edit coupon', ['class' => 'btn btn-outline-success']) !!}
            </div>

            {!! Form::close() !!}
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-info btn-sm">Back</a>
        </div>

    </div>

@endsection
