@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex py-3">
                <h4 class="m-0 font-weight-bold text-success">Comments</h4>
            </div>
            <div class="col-11 mr-auto">
                @include('admin.product_comments.filter.filter')
            </div>
            <div class="table-responsive">
                <table class="table table-content table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>User</th>
                            <th width="40%">Comment</th>
                            <th>Status</th>
                            <th>Create at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comments as $comment)
                            <tr>
                                <td><img src="{{ get_gravatar($comment->email, 50) }}" alt="" class="img-circle"></td>
                                <td>
{{--                                    <a href="{!! $comment->url != '' ? $comment->url : 'javascript:void(0);' !!}" target="{!! $comment->url != '' ? '_blank' : '' !!}">--}}
                                    <a href="{{ route('admin.users.show', $comment->user->id) }}">
                                        {{ $comment->name }}</a>
                                    {{ $comment->user_id != '' ? '(Member)' : '' }}
                                </td>
                                <td>
                                    {!! $comment->comment !!}
                                    <div class="text-muted">
                                        <a href="{{ route('admin.products.show', $comment->product_id) }}">{{ $comment->product->name }}</a>
                                    </div>
                                </td>
                                <td>{{ $comment->status() }}</td>
                                <td>{{ $comment->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle">
                                        <a href="{{ route('admin.product-comments.edit', $comment->id) }}" title="Edit" class="btn-primary btn btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" onclick="if (confirm('Are You sure want to Delete?'))
                                            { document.getElementById('comment-delete-{{ $comment->id }}').submit(); } else { return false; }"
                                           title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.product-comments.destroy', $comment->id) }}" method="post" id="comment-delete-{{ $comment->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No comments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="6">
                            <div class="float-right">
                            {!! $comments->appends(request()->input())->links() !!}
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
