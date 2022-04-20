@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
    <div class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>Reset Password</h2>
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

                                <form action="{{ route('password.email') }}" method="POST">
                                    @csrf

                                    <label for="email">Email*</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Your Email">
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror

                                    <div class="button-box">
                                        <div class="login-toggle-btn">
                                            <button class="default-btn floatright" type="submit">Send Password Reset Link</button>
                                        </div>
                                        <div class="form-group row mb-0">
                                            @if (Route::has('frontend.login'))
                                                <a class="btn btn-link" href="{{ route('frontend.login') }}">
                                                    {{ __('Login?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
