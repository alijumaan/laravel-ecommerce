@extends('layouts.app')
@section('title', 'Cart')
@section('content')
    <div class="breadcrumb-area pt-20 pb-20" style="background-image: url('{{ asset('frontend/img/bg/16.jpg') }}')">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 class="text-dark">Cart</h2>
                <ul>
                    <li><a href="{{ route('home') }}" class="text-dark">home</a></li>
                    <li class="text-secondary"> cart</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="cart-main-area pt-5 mb-5">
        <div class="container">
            <!-- cart item area -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>images</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::instance('default')->content() as $item)
                                    <livewire:frontend.cart-item-component :item="$item->rowId" :key="$item->rowId"/>
                                @endforeach
                                <livewire:frontend.message.cart-not-found-component />
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>

            <!-- cart total -->
            <div class="row">
                <livewire:frontend.cart-total-component/>
            </div>
            <div class="row">
                <div class="col-md-4 ">
                    <a href="{{route('shop.index')}}"
                       class="btn btn-link text-decoration-none text-dark">
                        <i class="fas fa-long-arrow-alt-left mr-1"></i>
                        Continue to shopping
                    </a>
                </div>
                @if(Cart::instance('default')->count())
                <div class="col-md-4 ">
                    <livewire:frontend.button-proceed-to-checkout-component/>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
