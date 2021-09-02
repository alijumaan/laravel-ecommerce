@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="card shadow mb-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit user: ({{ $supervisor->full_name }})
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.supervisors.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                    </span>
                    <span class="text">Back to supervisors</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.supervisors.update', $supervisor) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input class="form-control" id="first_name" type="text" name="first_name" value="{{ old('first_name', $supervisor->first_name) }}">
                            @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input class="form-control" id="last_name" type="text" name="last_name" value="{{ old('last_name', $supervisor->last_name) }}">
                            @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" id="username" type="text" name="username" value="{{ old('username', $supervisor->username) }}">
                            @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" value="{{ old('email', $supervisor->email) }}">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input class="form-control" id="phone" type="text" name="phone" value="{{ old('phone', $supervisor->phone) }}">
                            @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status', $supervisor->status) == "Active" ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status', $supervisor->status) == "Inactive" ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="receive-email">Receive Email</label>
                        <select name="receive_email" id="receive-email" class="form-control">
                            <option value="">---</option>
                            <option value="1" {{ old('receive_email', $supervisor->receive_email) == 1 ? 'selected' : null }}>Yes</option>
                            <option value="0" {{ old('receive_email', $supervisor->receive_email) == 0 ? 'selected' : null }}>No</option>
                        </select>
                        @error('receive_email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password" class="text-danger">Change password</label>
                            <input class="form-control" id="password" type="password" name="password" value="{{ old('password') }}">
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="permissions">Permissions</label>
                            <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple">
                                @forelse($permissions as $permission)
                                    <option
                                        value="{{ $permission->id }}"
                                        {{ in_array($permission->name, $supervisorPermissions) ? 'selected' : null }}>
                                        {{ $permission->name }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                            @error('permissions')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if($supervisor->user_image)
                            <img class="mb-2" src="{{ asset('storage/images/users/' . $supervisor->user_image) }}" alt="{{ $supervisor->full_name }}" width="60" height="60">
                            <a  class="btn btn-sm btn-danger mb-2"
                                href="{{ route('admin.supervisors.remove_image', $supervisor->id) }}">Remove</a>
                        @else
                            <img src="{{ asset('img/avatar.png') }}" alt="{{ $supervisor->full_name }}" width="60" height="60">
                        @endif
                        <br>
                        <input type="file" name="user_image">
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    @include('backend.users.edit_password', ['user' => $supervisor])
@endsection
@section('scripts')
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            // select2
            function matchStart(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip if there is no 'children' property
                if (typeof data.children === 'undefined') {
                    return null;
                }

                // `data.children` contains the actual options that we are matching against
                var filteredChildren = [];
                $.each(data.children, function (idx, child) {
                    if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                        filteredChildren.push(child);
                    }
                });

                // If we matched any of the timezone group's children, then set the matched children on the group
                // and return the group object
                if (filteredChildren.length) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.children = filteredChildren;

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            $(".select2").select2({
                tags: true,
                closeOnSelect: false,
                minimumResultsForSearch: Infinity,
                matcher: matchStart
            });
        })
    </script>
@endsection
