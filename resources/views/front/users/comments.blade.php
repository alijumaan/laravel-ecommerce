@extends('front.layouts.app')

@section('content')

    <div class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>My comments</h2>
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
                @include('front.users._sidebar')
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
                                @forelse($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->product->name }}</td>
                                        <td>{{ $comment->comment }}</td>
                                    </tr>
                                @empty
                                    <td>No comments found.</td>
                                @endforelse
                            </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3">{!! $comments->links() !!}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection































