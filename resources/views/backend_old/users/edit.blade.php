@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header d-flex">
            <h4 class="m-0 font-weight-bold text-success">Edit user {{ $user->name }}</h4>
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
            {!! Form::model($user, ['route' => ['admin.users.update', $user->id],'method' => 'patch', 'files' => true]) !!}

            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', old('name', $user->name), ['class' => 'form-control']) !!}
                        @error('name')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('username', 'Username') !!}
                        {!! Form::text('username', old('username', $user->username), ['class' => 'form-control']) !!}
                        @error('username')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', old('email', $user->email), ['class' => 'form-control']) !!}
                        @error('email')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('mobile', 'Mobile') !!}
                        {!! Form::text('mobile', old('mobile', $user->mobile), ['class' => 'form-control']) !!}
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
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', ['' => '---', '1' => 'Active', '0' => 'Inactive'] , old('status', $user->status), ['class' => 'form-control']) !!}
                        @error('status')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('role_id', 'Role') !!}
                        {!! Form::select('role_id', ['' => '---', '1' => 'Admin', '2' => 'Supervisor', '3' => 'User'] , old('role_id', $user->role_id), ['class' => 'form-control']) !!}
                        @error('role_id')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('receive_email', 'Receive Email') !!}
                        {!! Form::select('receive_email', ['' => '---', '1' => 'Yes', '0' => 'No'] , old('receive_email', $user->receive_email), ['class' => 'form-control']) !!}
                        @error('receive_email')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('bio', 'Bio') !!}
                        {!! Form::textarea('bio', old('bio', $user->bio), ['class' => 'form-control']) !!}
                        @error('bio')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                @if($user->user_image != '')
                    <div class="col-12 d-flex">
                        <img id="avatar_img" src="{{ asset('storage/' . $user->user_image) }}" class="img-fluid" width="150px" alt="{{ $user->name }}">
                    </div>
                @endif
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::file('user_image', ['class' => 'd-none', 'id' => 'avatar_file']) !!}
                        @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group pt-4">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>

    </div>

@endsection
@section('script')
    <script>
        $(function () {

            $(document).ready(function(){

                $('#avatar_img').click(function() {
                    $("input[id='avatar_file']").click();
                });

                $("#avatar_file").change(function(){
                    let reader = new FileReader();
                    reader.onload = function()
                    {
                        $("#avatar_img").addClass("avatar_preview").attr("src", reader.result);
                    }
                    reader.readAsDataURL(event.target.files[0]);
                });
            });

            //   Script for remove Image
            {{--$('.removeImage').click(function (){--}}
            {{--    $.post('{{ route('admin.users.remove-image') }}', { user_id: '{{ $user->id }}', _token: '{{ csrf_token() }}' }, function (data) {--}}
            {{--        if (data == 'true') {--}}
            {{--            window.location.href = window.location;--}}
            {{--        }--}}
            {{--    })--}}
            {{--});--}}
        });
    </script>
@endsection
