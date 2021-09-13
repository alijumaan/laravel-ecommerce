@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex py-3">
                <h4 class="m-0 font-weight-bold text-success">Links</h4>
                <div class="ml-auto">
                    @can('create_link')
                        <a href="{{ route('admin.links.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                            <span class="text">New link</span>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-content table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>As</th>
                            <th>To</th>
                            <th>Icon</th>
                            <th>Permission</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($links as $link)
                            <tr>
                                <td class="text-danger">{{ $link->title }}</td>
                                <td>{{ $link->as }}</td>
                                @if(in_array($link->to, $routes_name))
                                    <td>{{ $link->to }}</td>
                                @else
                                    <td>
                                        {{ $link->to }}<br>
                                        <b class="text-danger">
                                            invalid link
                                            <i class="fas fa-skull-crossbones"></i>
                                        </b>
                                        <br>
                                        <small class="text-danger">Please, Don't coding when feeling sleep</small>
                                    </td>
                                @endif
                                <td>
                                    <i class="{{ $link->icon }}"></i><br>
                                    <small>{{ $link->icon }}</small>
                                </td>
                                <td>{{ $link->permission_title }}</td>
                                <td>{{ $link->status }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle">
                                        <a href="{{ route('admin.links.edit', $link) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="if (confirm('Are You sure want to Delete?'))
                                            { document.getElementById('link-delete-{{ $link->id }}').submit(); } else { return false; }"
                                           title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.links.destroy', $link->id) }}" method="post" id="link-delete-{{ $link->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No links found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="5">
                            <div class="float-right">
                            {!!$links->appends(request()->all())->links() !!}
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
