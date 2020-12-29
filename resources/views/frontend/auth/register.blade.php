@extends('frontend.layouts.app')

@section('content')

    <div class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>register</h2>
                <ul>
                    <li><a href="{{route('frontend.login.form')}}">login</a></li>
                    <li> register </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="register-area ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="form-group">

                                {!! Form::open(['route' => 'frontend.register', 'method' => 'post', 'files' => true]) !!}

                                <div class="mb-2">
                                    {!! Form::label('name', 'Name *') !!}
                                    {!! Form::text('name', old('name'), ['placeholder' => 'Your name']) !!}
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-2">
                                    {!! Form::label('username', 'Username *') !!}
                                    {!! Form::text('username', old('username'), ['placeholder' => 'Username']) !!}
                                    @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-2">
                                    {!! Form::label('email', 'Email *') !!}
                                    {!! Form::email('email', old('email'), ['placeholder' => 'Your email']) !!}
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-2">
                                    {!! Form::label('mobile', 'Mobile') !!}
                                    {!! Form::text('mobile', old('mobile'), ['placeholder' => 'Your mobile']) !!}
                                    @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-2">
                                    {!! Form::label('password', 'Password *') !!}
                                    {!! Form::password('password', ['placeholder' => 'Password']) !!}
                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-2">
                                    {!! Form::label('password_confirmation', 'Confirm password *') !!}
                                    {!! Form::password('password_confirmation', ['placeholder' => 'confirm password']) !!}
                                    @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-0">
                                    {!! Form::label('user_image', 'User image') !!}
                                    {!! Form::file('user_image', ['class' => 'custom-file']) !!}
                                    @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="button-box">
                                    <div class="login-toggle-btn">
                                        {!! Form::button('Register', ['type' => 'submit', 'class' => 'default-btn floatright']) !!}
                                    </div>
                                </div>

                                <div class="form-group row m-0">
                                    @if (Route::has('frontend.login'))
                                        <a class="btn btn-link" href="{{ route('frontend.login') }}">
                                            {{ __('Login?') }}
                                        </a>
                                    @endif
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
