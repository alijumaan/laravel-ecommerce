@extends('backend.layouts.app')

@section('content')

    <div class="card shadow-sm mb-2">
        <div class="card-header d-flex py-3">
            <h4 class="m-0 font-weight-bold text-success">( {{ $product->name }} )</h4>
            <div class="ml-auto">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-success">
            <span class="icon text-success-50">
                <i class="fa fa-home"></i>
            </span>
                    <span class="text">All product</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <th>Price</th>
                    <th>${{ $product->price }}</th>
                    <th>Category</th>
                    <th colspan="2">{{ $product->category->name }}</th>
                </tr>
                <tr>
                    <th>Description</th>
                    <th colspan="3">{{ $product->description }}</th>
                </tr>
                <tr>
                    <th>Details</th>
                    <th colspan="3">{{ $product->details }}</th>
                </tr>
                <tr>
                    <th>Comments</th>
                    <th>{{ $product->comment_able == 1 ? $product->comments->count() : 'Disallow' }}</th>
                    <th>In stock</th>
                    <th colspan="2">{{ $product->inStock() }}</th>

                </tr>
                <tr>
                    <th>Created date</th>
                    <th colspan="3" >{{ $product->created_at->format('d-m-Y') }}</th>
                </tr>
                <tr>
                    <th colspan="4">
                        <div class="row">
                            @if($product->media->count() > 0)
                                @foreach($product->media as $media)
                                    <div class="col-2">
                                        <img src="{{asset('storage/'. $media->file_name) }}" class="img-fluid" alt="">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm mb-2">
        <div class="card-header d-flex py-3">
            <h4 class="m-0 font-weight-bold text-success">Reviews</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-content table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>comment</th>
                    <th>Status</th>
                    <th>Create at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($product->reviews as $review)
                    <tr>
                        <td><img src="{{ get_gravatar($review->email, 50) }}" alt="" class="img-circle"></td>
                        <td>{{ $review->name }}</td>
                        <td>{!! $review->review !!}</td>
                        <td>{{ $review->status() }}</td>
                        <td>{{ $review->created_at->format('d-m-Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-toggle">
                                <a href="{{ route('admin.reviews.edit', $review->id) }}" title="Edit" class="btn-primary btn btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);"
                                   onclick="if (confirm('Are You sure want to Delete?')) { document.getElementById('review-delete-{{ $review->id }}').submit(); } else { return false; }"
                                   title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                </a>
                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="post" id="review-delete-{{ $review->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No comments found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
