@extends('backend.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/summernote/summernote-bs4.min.css') }}">
@endsection

@section('content')
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>
        </div>
        <div class="card-body">
          <div class="container">
            <form method="POST" action="{{route('pages.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-5 form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="slug"  value="" placeholder="ex: About">
                </div>

                <div class="col-lg-5 form-group">
                    <label for="title">Description</label>
                    <input type="text" class="form-control" name="title"  value="" placeholder="ex: About us ">
                </div>

                <div class="col-lg-12 form-group">
                    <label for="body">Content</label>
                    <textarea name="content" class="form-control summernote"></textarea>
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

<script src="{{ asset('backend/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>

@endsection
