@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0 font-weight-bold text-success">Supervisors</h4>
                    <div class="ml-auto">
                        <a href="{{ route('admin.supervisors.create') }}" class="btn btn-outline-success">
                        <span class="icon text-success-50">
                            <i class="fa fa-plus"></i>
                        </span>
                            <span class="text">Add new supervisor</span>
                        </a>
                    </div>
                </div>
                <div class="col-12 mr-auto">
                    @include('admin.supervisors.filter.filter')
                </div>
                <div class="table-responsive">
                    <table class="table table-content table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email & Mobile</th>
                            <th>Status</th>
                            <th>Create at</th>
                            <th class="text-center" style="width: 30px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    @if ($user->user_image != '')
                                        <img src="{{asset('uploads/users/'.$user->user_image) }}" width="60px;">
                                    @else
                                        <img src="{{asset('uploads/default.png') }}" width="60px;">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.supervisors.show', $user->id) }}">{{ $user->name }}</a>
                                    <p class="text-secondary">{{ $user->username }}</p>
                                </td>
                                <td>
                                    {{ $user->email }}
                                    <p class="text-secondary">{{ $user->mobile }}</p>
                                </td>
                                <td>{{ $user->status() }}</td>
                                <td>{{ $user->created_at->format('d-m-Y h:i a') }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle">
                                        <a href="{{ route('admin.supervisors.edit', $user->id) }}" title="Edit" class="btn-primary btn btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" onclick="if (confirm('Are You sure want to Delete?'))
                                            { document.getElementById('supervisor-delete-{{ $user->id }}').submit(); } else { return false; }"
                                           title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.supervisors.destroy', $user->id) }}" method="post" id="supervisor-delete-{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="6" class="text-center">No supervisors found.</th>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="6">
                                <div class="float-right">
                                    {!! $users->appends(request()->input())->links() !!}
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

