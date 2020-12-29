@extends('backend.layouts.app')

@section('content')

    <div class="card">
        <div class="card-header d-flex">
            <h4 class="m-0 font-weight-bold text-success">Add user</h4>
            <div class="ml-auto">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-success">
                        <span class="icon text-primary-50">
                            <i class="fa fa-home"></i>
                        </span>
                    <span class="text">Users</span>
                </a>
            </div>
        </div>

        <div class="card-body">
            {!! Form::open(['route' => 'admin.users.store','method' => 'post', 'files' => true]) !!}

            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        @error('name')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('username', 'Username') !!}
                        {!! Form::text('username', old('username'), ['class' => 'form-control']) !!}
                        @error('username')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                        @error('email')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('mobile', 'Mobile') !!}
                        {!! Form::text('mobile', old('mobile'), ['class' => 'form-control']) !!}
                        @error('mobile')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        {!! Form::password('password', ['class' => 'form-control', 'type' => 'password']) !!}
                        @error('username')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('role_id', 'Role') !!}
                        {!! Form::select('role_id', ['' => '---', '1' => 'Admin', '2' => 'Supervisor', '3' => 'User'] , old('role_id'), ['class' => 'form-control']) !!}
                        @error('role_id')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', ['' => '---', '1' => 'Active', '0' => 'Inactive'] , old('status'), ['class' => 'form-control']) !!}
                        @error('status')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('receive_email', 'Receive Email') !!}
                        {!! Form::select('receive_email', ['' => '---', '1' => 'Yes', '0' => 'No'] , old('receive_email'), ['class' => 'form-control']) !!}
                        @error('receive_email')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('bio', 'Bio') !!}
                        {!! Form::textarea('bio', old('bio'), ['class' => 'form-control']) !!}
                        @error('bio')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group pt-4">
                {!! Form::submit('Add user', ['class' => 'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}
        </div>

    </div>
@endsection
