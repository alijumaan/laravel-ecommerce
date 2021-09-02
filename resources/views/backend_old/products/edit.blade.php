@extends('layouts.admin')

@section('style')
        <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
        <!-- Fileinput -->
        <link href="{{ asset('backend/vendor/bootstrap-fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection


@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="header">Edit Product ({{ $product->name }})</h4>
        </div>

        <div class="card-body">
            @include('backend.partial.edit_product_form')
        </div>

    </div>

@endsection
@section('script')

        <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>

        <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
        <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
        <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/purify.min.js') }}"></script>
        <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
        <script src="{{ asset('backend/vendor/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>

    <script>
        $(function () {
            $('.select-multiple-tags').select2({
            minimumResultsForSearch: Infinity,
            tags: true,
            closeOnSelect: false
            });
        });
    </script>

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
                        "{{ asset('storage/' . $media->file_name) }}",
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
