@extends('layouts.app')
@section('title', 'Shop products')
@section('content')
    <div class="shop-page-wrapper shop-page-padding ptb-100">
        <div class="container m-auto">
            <div class="row">
                <div class="col-lg-3">
                    @include('partials.frontend.shop.sidebar')
                </div>
                <div class="col-lg-9">
                    <livewire:frontend.product.shop-products-component  :slug="$slug"/>
                </div>
            </div>
        </div>
    </div>
@endsection

