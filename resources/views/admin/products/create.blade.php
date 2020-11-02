@extends('admin.layouts.app')

@section('content')

    <div class="card">
        <div class="card-header d-flex">
            <h4 class="m-0 font-weight-bold text-success">Add product</h4>
            <div class="ml-auto">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-success">
                        <span class="icon text-primary-50">
                            <i class="fa fa-home"></i>
                        </span>
                    <span class="text">Product</span>
                </a>
            </div>
        </div>

        <div class="card-body">
            {!! Form::open(['route' => 'admin.products.store','method' => 'post', 'files' => true]) !!}

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Product Name') !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        @error('name')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('category_id', 'Category') !!}
                        {!! Form::select('category_id', ['' => '---'] + $categories->toArray(), old('category_id'), ['class' => 'form-control']) !!}
                        @error('category_id')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
                        @error('description')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('details', 'Details') !!}
                        {!! Form::textarea('details', old('details'), ['class' => 'form-control']) !!}
                        @error('details')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-3">
                    {!! Form::label('price', 'Price') !!}
                    {!! Form::text('price', old('price'), ['class' => 'form-control']) !!}
                    @error('price')<span class="text-danger">{!!  $message  !!}</span>@enderror
                </div>
                <div class="col-3">
                    {!! Form::label('tags', 'Tag') !!}
                    {!! Form::select('tags[]', [] + $tags->toArray(), old('tags'), ['class' => 'form-control select-multiple-tags', 'multiple' => 'multiple']) !!}
                    @error('tags')<span class="text-danger">{!!  $message  !!}</span>@enderror
                </div>
                <div class="col-3">
                    {!! Form::label('comment_able', 'Comment able') !!}
                    {!! Form::select('comment_able', ['1' => 'Yes', '0' => 'No'], old('comment_able'), ['class' => 'form-control']) !!}
                    @error('comment_able')<span class="text-danger">{!!  $message  !!}</span>@enderror
                </div>
                <div class="col-3">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status'), ['class' => 'form-control']) !!}
                    @error('status')<span class="text-danger">{!!  $message  !!}</span>@enderror
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-12">
                    {!! Form::label('Sliders', 'images') !!}
                    <br>
                    <div class="file-loading">
                        {!! Form::file('images[]', ['id' => 'product-images', 'multiple' => 'multiple', 'class' => 'file-input-overview']) !!}
                        <span class="form-text text-muted">Image width should be 600px x 400px</span>
                        @error('images')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group pt-4">
                        {!! Form::submit('Add product', ['class' => 'btn btn-success']) !!}
                    </div>

            {!! Form::close() !!}
        </div>

    </div>

@endsection
@section('script')
    <script>
        $(function () {

            $('#product-images').fileinput({
                theme: "fas",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });

        });
    </script>
@endsection
