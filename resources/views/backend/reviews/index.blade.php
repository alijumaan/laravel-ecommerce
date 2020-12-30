@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex py-3">
                <h4 class="m-0 font-weight-bold text-success">Reviews</h4>
            </div>
            <div class="col-11 mr-auto">
                @include('backend.reviews.filter.filter')
            </div>
            <div class="table-responsive">
                <table class="table table-content table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>User</th>
                            <th width="40%">Review</th>
                            <th>Status</th>
                            <th>Create at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td><img src="{{ get_gravatar($review->email, 50) }}" alt="" class="img-circle"></td>
                                <td>
{{--                                    <a href="{!! $review->url != '' ? $review->url : 'javascript:void(0);' !!}" target="{!! $review->url != '' ? '_blank' : '' !!}">--}}
                                    <a href="{{ route('admin.users.show', $review->user->id) }}">
                                        {{ $review->name }}</a>
                                    {{ $review->user_id != '' ? '(Member)' : '' }}
                                </td>
                                <td>
                                    {!! $review->review !!}
                                    <div class="text-muted">
                                        <a href="{{ route('admin.products.show', $review->product_id) }}">{{ $review->product->name }}</a>
                                    </div>
                                </td>
                                <td>{{ $review->status() }}</td>
                                <td>{{ $review->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle">
                                        <a href="{{ route('admin.reviews.edit', $review->id) }}" title="Edit" class="btn-primary btn btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" onclick="if (confirm('Are You sure want to Delete?'))
                                            { document.getElementById('review-delete-{{ $review->id }}').submit(); } else { return false; }"
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
                                <td colspan="6" class="text-center">No reviews found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="6">
                            <div class="float-right">
                            {!! $reviews->appends(request()->input())->links() !!}
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
