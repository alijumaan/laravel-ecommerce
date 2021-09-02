@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex py-3">
                <h4 class="m-0 font-weight-bold text-success">Tags</h4>
                <div class="ml-auto">
                    <a href="{{ route('admin.tags.create') }}" class="btn btn-outline-success">
                        <span class="icon text-success-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Add new coupon</span>
                    </a>
                </div>
            </div>
            <div class="col-11 mr-auto">
                @include('backend.tags.filter.filter')
            </div>
            <div class="table-responsive">
                <table class="table table-content table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Products Count</th>
                            <th>Status</th>
                            <th>Create at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td><a href="{{ route('admin.products.index', ['tag_id' => $tag->id]) }}">{{ $tag->products_count }}</a></td>
                                <td>{{ $tag->status }}</td>
                                <td>{{ $tag->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle">
                                        <a href="{{ route('admin.tags.edit', $tag->id) }}" title="Edit" class="btn-primary btn btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" onclick="if (confirm('Are You sure want to Delete?'))
                                            { document.getElementById('tag-delete-{{ $tag->id }}').submit(); } else { return false; }"
                                           title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="post" id="tag-delete-{{ $tag->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="3" class="text-center">No tags found.</th>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3">
                            <div class="d-flex justify-content-start">
                            {!! $tags->appends(request()->input())->links() !!}
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
