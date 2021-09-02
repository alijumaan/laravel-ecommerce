@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Product Reviews
            </h6>
            <div class="ml-auto"></div>
        </div>

        @include('partials.backend.filter', ['model' => route('admin.reviews.index')])

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Rating</th>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($reviews as $review)
                    <tr>
                        <td>
                            <a href="{{ route('admin.reviews.show', $review->id) }}">
                                {{ $review->user_id ? $review->user->full_name : $review->name }}
                            </a><br>
                            <small>{{ $review->email }}</small><br>
                        </td>
                        <td>{{ $review->title }}</td>
                        <td><span class="badge badge-success">{{ $review->rating }}</span></td>
                        <td>{{ $review->product->name }}</td>
                        <td>{{ $review->status }}</td>
                        <td>{{ $review->created_at ? $review->created_at->format('Y-m-d') : '' }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);"
                                   onclick="if (confirm('Are you sure to delete this record?'))
                                       {document.getElementById('delete-review-{{ $review->id }}').submit();} else {return false;}"
                                   class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('admin.reviews.destroy', $review) }}"
                                  method="POST"
                                  id="delete-review-{{ $review->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="7">No reviews found.</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="7">
                        <div class="float-right">
                            {!!$reviews->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
