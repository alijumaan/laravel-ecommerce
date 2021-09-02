@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Supervisors
            </h6>
            <div class="ml-auto">
                @can('create_supervisor')
                    <a href="{{ route('admin.supervisors.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                        <span class="text">Add supervisor</span>
                    </a>
                @endcan
            </div>
        </div>
        @include('partials.backend.filter', ['model' => route('admin.supervisors.index')])

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 30px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($supervisors as $supervisor)
                    <tr>
                        <td>{{ $supervisor->id }}</td>
                        <td>
                            @if($supervisor->user_image)
                                <img src="{{ asset('storage/images/users/' . $supervisor->user_image) }}" alt="{{ $supervisor->full_name }}" width="60" height="60">
                            @else
                                <img src="{{ asset('img/avatar.png') }}" alt="{{ $supervisor->full_name }}" width="60" height="60">
                            @endif
                        </td>
                        <td><a href="{{ route('admin.supervisors.show', $supervisor->id) }}">{{ $supervisor->full_name }}</a></td>
                        <td class="text-success">{{ str_replace("_", " ", $supervisor->getPermissionNames()->join(', ')) }} <br></td>
                        <td>{{ $supervisor->status }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.supervisors.edit', $supervisor) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);"
                                   onclick="if (confirm('Are you sure to delete this record?'))
                                       {document.getElementById('delete-tag-{{ $supervisor->id }}').submit();} else {return false;}"
                                   class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('admin.supervisors.destroy', $supervisor) }}"
                                  method="POST"
                                  id="delete-tag-{{ $supervisor->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">No supervisors found.</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="float-right">
                            {!! $supervisors->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
