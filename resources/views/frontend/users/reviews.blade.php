@extends('frontend.layouts.app')

@section('content')

    <div class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>My reviews</h2>
                <ul>
                    <li><a href="{{route('home')}}">home</a></li>
                    <li> My profile </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5 pb-5 ">
        <div class="row">
            <div class="col-lg-2" style="float: left">
                @include('frontend.users._sidebar')
            </div>
            <div class="col-lg-10" style="float: left">
                <div class="table-responsive card shadow p-2">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product name</th>
                            <th>content</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse($reviews as $review)
                                    <tr>
                                        <td>{{ $review->product->name }}</td>
                                        <td>{{ $review->$review }}</td>
                                    </tr>
                                @empty
                                    <td>No review found.</td>
                                @endforelse
                            </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3">{!! $reviews->links() !!}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection































