@extends('layouts.admin')

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0 font-weight-bold text-success">Categories</h4>
                    <div class="ml-auto">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-success">
                        <span class="icon text-success-50">
                            <i class="fa fa-plus"></i>
                        </span>
                            <span class="text">Add new category</span>
                        </a>
                    </div>
                </div>
                <div class="col-11 mr-auto">
                    @include('backend.categories.filter.filter')
                </div>
                <div class="table-responsive">
                    <table class="table table-content table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Products count</th>
                            <th>Parent</th>
                            <th>Status</th>
                            <th>Create at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    @if($category->cover)
                                        <img src="{{ asset('storage/images/categories/' . $category->cover) }}"
                                             width="60" height="60" alt="{{ $category->name }}">
                                    @else
                                        <img src="{{ asset('frontend/img/default/no-img.png') }}" width="60" height="60" alt="{{ $category->name }}">
                                    @endif
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('admin.products.index', ['category_id' => $category->id]) }}">
                                        {{ $category->products_count }}
                                    </a>
                                </td>
                                <td>{{ $category->parent->name ?? '' }}</td>
                                <td>{{ $category->status }}</td>
                                <td>{{ $category->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" title="Edit" class="btn-primary btn btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" onclick="if (confirm('Are You sure want to Delete?'))
                                            { document.getElementById('product-delete-{{ $category->id }}').submit(); } else { return false; }"
                                           title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" id="product-delete-{{ $category->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No categories found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="7">
                                <div class="float-right">
                                    {!! $categories->appends(request()->input())->links() !!}
                                </div>
                            </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
