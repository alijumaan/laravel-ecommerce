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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="cart-heading">wishlist</h1>
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th></th>
                                    <th>Move To Cart</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse(Cart::instance('wishlist')->content() as $item)
                                    <livewire:frontend.wishlist-item-component :item="$item->rowId" :key="$item->rowId"/>
                                @empty
                                    <tr>
                                        <td class="pl-0 border-light" colspan="5">
                                            <p class="text-center">No items in your wish list.</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

