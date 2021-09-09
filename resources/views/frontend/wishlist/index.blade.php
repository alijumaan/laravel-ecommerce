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
    <livewire:frontend.wishlist-item-component />
@endsection

