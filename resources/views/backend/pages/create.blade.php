@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/summernote/summernote-bs4.min.css') }}">
@endsection

@section('content')
      <div class="card mb-3">
          <div class="card-header d-flex">
              <i class="fa fa-table"></i>
              <a href="{{ route('admin.pages.index') }}" class="btn btn-primary ml-auto">Back</a>
          </div>
        <div class="card-body">
          <div class="container">
            <form method="POST" action="{{route('admin.pages.store')}}">
                @csrf
                <div class="col-6 form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title"  value="" placeholder="e.g. Privacy Policy ">
                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="col-6 form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug"  value="" placeholder="e.g. privacy-policy">
                    @error('slug')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="col-6 form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">---</option>
                        <option value="1" {{ old('status') == "1" ? 'selected' : null }}>Active</option>
                        <option value="0" {{ old('status') == "0" ? 'selected' : null }}>Inactive</option>
                    </select>
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="col-lg-12 form-group">
                    <label for="body">Content</label>
                    <textarea name="content" class="form-control summernote"></textarea>
                    @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="col-lg-12 form-group">
                    <button type="submit" class="btn btn-primary mt-3">Create</button>
                </div>
            </form>
          </div>
        </div>
      </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
