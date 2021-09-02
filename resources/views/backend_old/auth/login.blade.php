<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Ali Jumaan">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{  config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{  asset('css/app.css') }}">
    <style>
        body{
            padding-top: 10rem;
            background: rgb(54,217,182);
            background: linear-gradient(90deg, rgba(54,217,182,1) 0%, rgba(32,152,126,1) 43%, rgba(0,212,255,1) 100%);
        }
    </style>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                @include('messages.flash')
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Login') }}</h3>
                    </div>

                    <div class="card-body">

                        {!! Form::open(['route' => 'admin.login.form', 'method' => 'post']) !!}
                        <div class="form-group">
                            {!! Form::label('username', 'Username *', ['for' => 'username']) !!}
                            {!! Form::text('username', old('username'), ['placeholder' => 'Username', 'id' => 'username', 'class' => 'form-control']) !!}
                            @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', 'Password *', ['for' => 'password']) !!}
                            {!! Form::password('password', ['placeholder' => 'Password', 'id' => 'password', 'class' => 'form-control']) !!}
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        {{ Form::button('Login', ['class' => 'btn btn-success', 'type' => 'submit']) }}
                        {!! Form::close() !!}
                        <hr>
                        <div class="text-content">
                            @if (Route::has('password.request'))
                                <a class="small" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ url('https://kit.fontawesome.com/8003f9e0e2.js') }}" crossorigin="anonymous"></script>
</body>
</html>
