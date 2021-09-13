@extends('layouts.admin')

@section('breadcrumb')
    &nbsp;{{ $page->title }}
@endsection

@section('content')
    <div class="card-header d-flex">
        <i class="fa fa-table"></i>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-primary ml-auto">Back</a>
    </div>
    <div class="row">
        <div class="col-md-12 bg-white content">
            <h3 class="my-2"> {{ $page->title }} </h3>
            <div>
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection
