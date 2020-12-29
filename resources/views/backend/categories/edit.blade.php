@extends('backend.layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0 font-weight-bold text-success">Edit Category ({{ $category->name }})</h4>
                    <div class="ml-auto">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-success">
                        <span class="icon text-success-50">
                            <i class="fa fa-home"></i>
                        </span>
                            <span class="text">Edit category</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($category, ['route' => ['admin.categories.update', $category->id], 'method' => 'patch']) !!}

                    @include('backend.categories._fields')

                    <div class="form-group pt-4">
                        {!! Form::submit('Update category', ['class' => 'btn btn-outline-success']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection
