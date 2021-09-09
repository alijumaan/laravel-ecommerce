@extends('layouts.app')
@section('title', 'User Dashboard')
@section('content')
    <section class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>Dashboard</h2>
                <ul>
                    <li><a href="{{route('home')}}">home</a></li>
                    <li> My profile</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="container pt-4 pb-5 ">
        <div class="row">
            <div class="col-lg-8">
                Dashboard
            </div>

            <div class="col-4">
                @include('partials.frontend.user.sidebar')
            </div>

        </div>
    </section>
@endsection
