@extends('admin.layouts.app')

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
                <div class="col-6">
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

            <div class="row pt-4">
                @if($user->user_image != '')
                    <div class="col-12 text-center">
                        <div id="imgArea">
                            <img src="{{ asset('uploads/users/' . $user->user_image) }}" width="200" height="">
                            <button class="btn btn-danger removeImage">Remove Image</button>
                        </div>
                    </div>
                @endif
                <div class="col-12">
                    {!! Form::label('User image', 'user_image') !!}
                    <br>
                    <div class="file-loading">
                        {!! Form::file('user_image', ['id' => 'user-image', 'class' => 'file-input-overview']) !!}
                        <span class="form-text text-muted">Image width should be 300px x 300px</span>
                        @error('user_image')<span class="text-danger">{!!  $message  !!}</span>@enderror
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

            $('#user-image').fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });

            $('.removeImage').click(function (){
                $.post('{{ route('admin.users.remove-image') }}', { user_id: '{{ $user->id }}', _token: '{{ csrf_token() }}' }, function (data) {
                    if (data == 'true') {
                        window.location.href = window.location;
                    }
                })
            });

        });
    </script>
@endsection
