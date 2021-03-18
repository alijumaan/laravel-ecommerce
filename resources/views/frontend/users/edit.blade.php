@extends('frontend.layouts.app')

@section('content')

    <div class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>Update information</h2>
                <ul>
                    <li><a href="{{route('home')}}">home</a></li>
                    <li> My profile</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5 pb-5 ">
        <div class="row">

            <div class="col-lg-3" style="float: left">
                @include('frontend.users._sidebar')
            </div>

            <div class="col-lg-9" style="float: left">
                <div class="row">

                    <div class="col-lg-12 col-md-12">

                        {!! Form::open(['route' => 'users.update_info','name' => 'user_info', 'id' => 'user_info', 'method' => 'post', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', old('name', auth()->user()->name), ['class' => 'form-control']) !!}
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::email('email', old('email', auth()->user()->email), ['class' => 'form-control']) !!}
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('mobile', 'Mobile') !!}
                                    {!! Form::text('mobile', old('mobile', auth()->user()->mobile), ['class' => 'form-control']) !!}
                                    @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('receive_email', 'Receive email') !!}
                                    {!! Form::select('receive_email', ['1' => 'Yes', '0' => 'No'], old('receive_email', auth()->user()->receive_email), ['class' => 'form-control']) !!}
                                    @error('receive_email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::label('bio', 'Bio') !!}
                                    {!! Form::textarea('bio', old('bio', auth()->user()->bio), ['class' => 'form-control']) !!}
                                    @error('bio')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @if(auth()->user()->avatar != '')
                                <div class="col-12">
                                    <img id="avatar_img" src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                         class="img-fluid" width="150px" alt="{{ auth()->user()->name }}">
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::file('avatar', ['class' => 'd-none', 'id' => 'avatar_file']) !!}
                                    @error('avatar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::submit('Update information', ['name' => 'update_information', 'class' => 'btn btn-outline-info']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <hr>

                        <h3>Update password</h3>
                        {!! Form::open(['route' => 'users.update_password', 'name' => 'user_password', 'id' => 'user_password', 'method' => 'post']) !!}

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('current_password', 'Current password') !!}
                                    {!! Form::password('current_password', ['class' => 'form-control']) !!}
                                    @error('current_password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('password', 'New password') !!}
                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('password_confirmation', 'Re password') !!}
                                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                    @error('password_confirmation')<span
                                        class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::submit('Update password', ['name' => 'update_password', 'class' => 'btn btn-outline-info']) !!}

                                </div>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function () {

            $('#avatar_img').click(function () {
                $("input[id='avatar_file']").click();
            });

            $("#avatar_file").change(function () {
                let reader = new FileReader();
                reader.onload = function () {
                    $("#avatar_img").addClass("avatar_preview").attr("src", reader.result);
                }
                reader.readAsDataURL(event.target.files[0]);
            });
        });
    </script>
@endsection





























