@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            @if($supervisor->user_image)
                <img src="{{ asset('storage/assets/images/users/' . $supervisor->user_image) }}" alt="" style="width: 70px;">
            @else
                <img src="{{ asset('default_images/avatar.png') }}" alt="" style="width: 70px;">
            @endif
            {{ $supervisor->full_name }}
            <div class="ml-auto">
                <a href="{{ route('admin.supervisors.index') }}" class="btn btn-primary">
                    <span class="text">Back to tags</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>First Name</th>
                    <td>{{ $supervisor->first_name }}</td>
                    <th>Last Name</th>
                    <td>{{ $supervisor->last_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $supervisor->email }}</td>
                    <th>Username</th>
                    <td>{{ $supervisor->username }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $supervisor->phone }}</td>
                    <th>Status</th>
                    <td>{{ $supervisor->status }}</td>
                </tr>
                <tr>
                    <td>Email Verified At</td>
                    <td>{{ $supervisor->email_verified_at ? $supervisor->email_verified_at->format('Y-m-d') : "Undefined" }}</td>
                    <td>Created At</td>
                    <td>{{ $supervisor->created_at ? $supervisor->created_at->format('Y-m-d') : "Undefined" }}</td>
                </tr>
                <tr>
                    <td>Permissions</td>
                    <td colspan="3" class="text-success">
                        <h5>{{ str_replace("_", " ", $supervisor->getPermissionNames()->join(', ')) }}</h5>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
