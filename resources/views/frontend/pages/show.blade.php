@extends('layouts.app')
@section('title', $static_page->title)
@section('content')
    <div class="container shadow-sm card mt-5 mb-5" style="border: none;">
        <div class="m-3">
            <div>
                <h3 class="text-center font-weight-bold">{{ $static_page->title }}</h3>
                <h4>{{ $static_page->title }}</h4>
                <p>{!! $static_page->content !!}</p>
            </div>
            <div>Last update: {{ $static_page->updated_at }}</div>
        </div>
    </div>
@endsection
