@extends('layouts.app')
@section('title', 'Wishlist')
@section('content')
    <div class="breadcrumb-area pt-70 pb-70" style="background-image: url('{{ asset('frontend/img/bg/16.jpg') }}')">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 class="text-success">wishlist</h2>
                <ul>
                    <li><a href="{{ route('home') }}" class="text-dark">home</a></li>
                    <li class="text-secondary"> wishlist </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- wishlist item area -->
    <div class="cart-main-area pt-50 pb-50 wishlist">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <h1 class="cart-heading">wishlist</h1>
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th  style="width: 5%">Move To Cart</th>
                                    <th>Price</th>
                                    <th  style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::instance('wishlist')->content() as $item)
                                    <livewire:frontend.wishlist.wishlist-item-component :item="$item->rowId" :key="$item->rowId"/>
                                @endforeach
                                <livewire:frontend.message.wishlist-not-found-component />
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

