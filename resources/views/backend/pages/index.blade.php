@extends('backend.layouts.app')

@section('content')
    @can('add-page')
        <p><a href="{{ route('pages.create') }}" class="btn btn-primary">Create New Page</a></p>
    @endcan
    <div class="card shadow bg-white">
        @include('backend.partial.pages')
    </div>
@endsection
