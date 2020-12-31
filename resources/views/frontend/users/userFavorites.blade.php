@extends('frontend.layouts.app')

@section('content')

    <div class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>My Favorite</h2>
                <ul>
                    <li><a href="{{route('home')}}">home</a></li>
                    <li> My Favorite </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5 pb-5 ">
        <div class="row">
            <div class="col-lg-2" style="float: left">
                @include('frontend.users._sidebar')
            </div>
            <div class="col-lg-10 justify-content-center">
            <h2>My Favorite</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($userFav as $product)
                    <tr>
                        <td>{{ $product->pivot->created_at->format('Y-m-d') }}</td>
                        <td><h5>{{ $product->name }}</h5></td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <div class="btn-group" role="group" >
                                <a  class="btn-sm btn-success" href="{{ route('frontend.products.show', $product->slug) }}" role="button" ><i class="glyphicon glyphicon-remove-sign"></i>Show</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <td colspan="4" class="text-center">No favorites found.</td>
                @endforelse
                </tbody>
            </table>
        </div>
        </div>
    </div>


@endsection
