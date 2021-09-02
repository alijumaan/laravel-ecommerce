@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit category: ({{ $category->name }})
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Back to categories</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" id="name" type="text" name="name" value="{{ old('name', $category->name) }}">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="parent_id">Parent</label>
                            @if($category->parent_id == 0)
                                <input class="form-control" value="{{ $category->name }}" readonly>
                            @else
                                <select name="parent_id" id="parent_id" class="form-control">
                                    @forelse($mainCategories as $mainCategory)
                                        <option value="{{ $mainCategory->id }}" {{ old('parent_id', $category->parent_id) == $mainCategory->id ? 'selected' : null }}>
                                            {{ $mainCategory->name }}
                                        </option>
                                    @empty
                                        <option value="" disabled>No categories found</option>
                                    @endforelse
                                    @endif
                                </select>
                                @error('parent_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status', $category->status) == "Active" ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status', $category->status) == "Inactive" ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="row">
                        <div class="col-12">
                            <label for="cover">Cover image</label><br>
                            @if($category->cover)
                                <img
                                    class="mb-2"
                                    src="{{ asset('storage/images/categories/' . $category->cover) }}"
                                    alt="{{ $category->name }}" width="100" height="100">
                                <a  class="btn btn-sm btn-danger mb-2"
                                    href="{{ route('admin.categories.remove_image', $category->id) }}">Remove</a>
                            @else
                                <img
                                    class="mb-2"
                                    src="{{ asset('img/no-img.png') }}" alt="{{ $category->name }}" width="60" height="60">
                            @endif
                            <br>
                            <input type="file" name="cover">
                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                            @error('cover')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
