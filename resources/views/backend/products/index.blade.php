@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex py-3">
                <h4 class="m-0 font-weight-bold text-success">Products</h4>
                <div class="ml-auto">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-success">
                        <span class="icon text-success-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Add new product</span>
                    </a>
                </div>
            </div>
            <div class="col-11 mr-auto">
                @include('backend.products.filter.filter')
            </div>
            <div class="table-responsive">
                <table class="table table-content table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>comments</th>
                            <th>In stock</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Create at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a></td>
                                <td>
                                    {!! $product->comment_able == 1 ? "<a href=\"" . route('admin.product-comments.index', ['product-id' => $product->id]) . "\">" . $product->comments->count() . "</a>" : 'Disallow'  !!}
                                </td>
                                <td>{{ $product->inStock() }}</td>
                                <td><a href="{{ route('admin.products.index', ['category_id' => $product->category_id]) }}">{{ $product->category->name }}</a></td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    @if($product->media->count() > 0)
                                    <img src="{{asset('storage/'.$product->media[0]->file_name) }}" alt="{{$product->name}}" style="width: 50px;">
                                    @endif
                                </td>
                                <td>{{ $product->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" title="Edit" class="btn-primary btn btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" onclick="if (confirm('Are You sure want to Delete?'))
                                            { document.getElementById('product-delete-{{ $product->id }}').submit(); } else { return false; }"
                                           title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" id="product-delete-{{ $product->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="9">
                            <div class="float-right">
                            {!! $products->appends(request()->input())->links() !!}
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
