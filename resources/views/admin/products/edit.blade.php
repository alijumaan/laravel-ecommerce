@extends('admin.layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="header">Edit Product ({{ $product->name }})</h4>
        </div>

        <div class="card-body">
            {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'patch', 'files' => true]) !!}

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
                    {!! Form::select('tags[]', [] + $tags->toArray(), old('tags', $product->tags->pluck('id')->toArray()), ['class' => 'form-control select-multiple-tags', 'multiple' => 'multiple']) !!}
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
                {!! Form::submit('Edit product', ['class' => 'btn btn-outline-success']) !!}
            </div>

            {!! Form::close() !!}
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-info btn-sm">Back</a>
        </div>

    </div>

@endsection
@section('script')
    <script>
        $(function () {
            $('#product-images').fileinput({
                theme: "fas",
                maxFileCount: {{ 5 - $product->media->count() }},
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if($product->media->count() > 0)
                        @foreach($product->media as $media)
                        "{{ asset('uploads/products/' . $media->file_name) }}",
                    @endforeach
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                        @if($product->media->count() > 0)
                        @foreach($product->media as $media)
                    { caption: "{{ $media->file_name }}",
                        size: "{{ $media->file_size }}",
                        width: "120px",
                        url: "{{ route('products.media.destroy', [$media->id, '_token' => csrf_token()]) }}",
                        key: "{{ $media->id }}"
                    },
                    @endforeach
                    @endif
                ],
            });

        });
    </script>
@endsection
