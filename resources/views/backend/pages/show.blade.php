@extends('backend.layouts.app')

@section('breadcrumb')
    &nbsp;{{ $page->title }}
@endsection

@section('content')
    <p><a href="{{ route('pages.index') }}" class="btn btn-primary">Back</a></p>
<div class="row">
    <div class="col-md-12 bg-white content">
        <h3 class="my-4"> {{ $page->title }} </h3>
        {!! $page->content !!}
    </div>
</div>
@endsection
