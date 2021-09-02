@extends('layouts.admin')

@section('content')
      <div class="card mb-3">
        <div class="card-header d-flex">
          <i class="fa fa-table"></i>
            <a href="{{ route('pages.index') }}" class="btn btn-primary ml-auto">Back</a>
        </div>
        <div class="card-body">
          <div class="container">
            <form method="POST" action="{{route('pages.update', $page->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="col-lg-5 form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="slug"  value="{{ $page->slug }}">
                </div>

                <div class="col-lg-5 form-group">
                    <label for="title">Description</label>
                    <input type="text" class="form-control" name="title"  value="{{ $page->title }}" >
                </div>

                <div class="col-lg-12 form-group">
                    <label for="body">Content</label>
                    <textarea name="content" class="form-control summernote">{{ $page->content }}</textarea>
                </div>

                <div class="col-lg-12 form-group">
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </div>
            </form>
          </div>
        </div>
      </div>
@endsection

@section('scripts')

<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>

@endsection
