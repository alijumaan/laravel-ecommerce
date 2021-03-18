@extends('frontend.layouts.app')

@section('content')

    <div class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>My Favorite</h2>
                <ul>
                    <li><a href="{{route('home')}}">home</a></li>
                    <li> My Favorite</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="cart-main-area pt-95 pb-100 wishlist">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3" style="float: left">
                    @include('frontend.users._sidebar')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <h1 class="cart-heading">wishlist</h1>
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($userFav as $product)
                                    <tr>
                                        <td class="product-name"><a href="#">{{ $product->name }}</a></td>
                                        <td class="product-price-cart"><span
                                                class="amount">${{ $product->price }}</span></td>
                                        <td>
                                            <a class="btn-sm btn-success"
                                               href="{{ route('frontend.products.show', $product->slug) }}"
                                               role="button"><i class="glyphicon glyphicon-remove-sign"></i>Show</a>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="4" class="text-center">No favorites found.</td>
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
