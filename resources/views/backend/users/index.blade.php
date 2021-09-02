@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Customers
            </h6>
            <div class="ml-auto">
                @can('create_user')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                        <span class="text">Add user</span>
                    </a>
                @endcan
            </div>
        </div>
        @include('partials.backend.filter', ['model' => route('admin.users.index')])

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name & Username</th>
                    <th>Email & Phone</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            @if($user->user_image)
                                <img src="{{ asset('storage/images/users/' . $user->user_image) }}" alt="{{ $user->full_name }}" class="img-profile rounded-circle">
                            @else
                                <img src="{{ asset('img/avatar.png') }}" alt="{{ $user->full_name }}" width="60" height="60">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.users.show', $user->id) }}">
                                {{ $user->full_name }}
                            </a><br>
                            <strong>( {{ $user->username }} )</strong>
                        </td>
                        <td>{{ $user->email }}<br>
                            {{ $user->phone }}
                        </td>
                        <td>{{ $user->status }}</td>
                        <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : '' }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);"
                                   onclick="if (confirm('Are you sure to delete this record?'))
                                       {document.getElementById('delete-tag-{{ $user->id }}').submit();} else {return false;}"
                                   class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('admin.users.destroy', $user) }}"
                                  method="POST"
                                  id="delete-tag-{{ $user->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">No users found.</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="float-right">
                            {!! $users->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
