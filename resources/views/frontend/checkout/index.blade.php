@extends('frontend.layouts.app')

@section('content')
    <div class="checkout-area pt-5 pb-5">
        <div class="container">
            <div id="success"
                 style="display: none"
                 class="col-md-8 text-center h3 p-4 bg-success text-light rounded">
                The purchase was completed successfully
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        @include('frontend.partials.coupon_section')
                    </div>
                </div>

                {!! Form::open(['route' => 'checkout.store', 'method' => 'post']) !!}
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        @include('frontend.partials.billing_address')

                        @include('frontend.partials.different_address')
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        @include('frontend.partials.order_view')
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection


