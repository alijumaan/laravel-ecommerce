@extends('layouts.app')
@section('content')
    <div class="container shadow-sm card mt-5 mb-5">
        <div class="m-3">
            <div>
                <h3 class="text-center font-weight-bold">{{ $static_page->title }}</h3>
                <h4>{{ $static_page->title }}</h4>
                <p>{!! $static_page->content !!}</p>
            </div>
            <div class="text-right">Last update: {{ $static_page->updated_at }}</div>
        </div>
    </div>
@endsection
