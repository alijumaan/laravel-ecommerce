@extends('layouts.app')
@section('title', 'Shop '.$slug)
@section('content')
    <div class="shop-page-wrapper shop-page-padding ptb-100">
        <div class="container-fluid m-auto">
            <div class="row">
                <div class="col-lg-3">
                    @include('partials.frontend.shop.sidebar')
                </div>
                <div class="col-lg-9">
                    <livewire:frontend.product.shop-products-tag-component  :slug="$slug"/>
                </div>
            </div>
        </div>
    </div>
@endsection

