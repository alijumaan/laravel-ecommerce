@extends('backend.layouts.app')

@section('content')

    <div class="card">
        <div class="card-header d-flex">
            <h4 class="m-0 font-weight-bold text-success">Add Tag</h4>
            <div class="ml-auto">
                <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-success">
                        <span class="icon text-primary-50">
                            <i class="fa fa-home"></i>
                        </span>
                    <span class="text">tag</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'admin.tags.store','method' => 'post']) !!}
                    @include('backend.tags._fields')
                    <div class="form-group pt-4">
                        {!! Form::submit('Add tag', ['class' => 'btn btn-success']) !!}
                    </div>
            {!! Form::close() !!}
        </div>

    </div>

@endsection
