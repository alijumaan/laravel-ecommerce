@extends('backend.layouts.app')

@section('style')
    <!-- Select2- -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
    <!-- Fileinput -->
    <link href="{{ asset('backend/vendor/bootstrap-fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="card">
        <div class="card-header d-flex">
            <h4 class="m-0 font-weight-bold text-success">Add supervisor</h4>
            <div class="ml-auto">
                <a href="{{ route('admin.supervisors.index') }}" class="btn btn-outline-success">
                        <span class="icon text-primary-50">
                            <i class="fa fa-home"></i>
                        </span>
                    <span class="text">Supervisors</span>
                </a>
            </div>
        </div>

        <div class="card-body">
            {!! Form::open(['route' => 'admin.supervisors.store','method' => 'post', 'files' => true]) !!}

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
                        @error('password')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', ['' => '---', '1' => 'Active', '0' => 'Inactive'] , old('status'), ['class' => 'form-control']) !!}
                        @error('status')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
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

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('permissions', 'Permissions') !!}
                        @include('backend.partial.permissions')
                        @error('permissions')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="form-group pt-4">
                {!! Form::submit('Add supervisor', ['class' => 'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/purify.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
    <script>
        $(function () {
            $('.select-multiple-tags').select2({
                minimumResultsForSearch: Infinity,
                tags: true,
                closeOnSelect: false
            });
            $('#user_image').fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            })
        });
    </script>
@endsection
