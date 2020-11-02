@extends('admin.layouts.app')

@section('content')

    <div class="card">
        <div class="card-header d-flex">
            <h4 class="m-0 font-weight-bold text-success">Add category</h4>
            <div class="ml-auto">
                <a href="{{ route('admin.product-categories.index') }}" class="btn btn-outline-success">
                        <span class="icon text-primary-50">
                            <i class="fa fa-home"></i>
                        </span>
                    <span class="text">Categories</span>
                </a>
            </div>
        </div>

        <div class="card-body">
            {!! Form::open(['route' => 'admin.product-categories.store','method' => 'post']) !!}

            @include('admin.product_categories._fields')

            <div class="form-group pt-4">
                {!! Form::submit('Add category', ['class' => 'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}
        </div>

    </div>

@endsection

