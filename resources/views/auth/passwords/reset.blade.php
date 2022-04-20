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

                                <form action="{{ route('password.update') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="mb-2">
                                        <label for="email">Email*</label>
                                        <input type="email" id="email" name="email" placeholder="Your email" value="{{ old('email') }}">
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mb-2">
                                        <label for="password">Password*</label>
                                        <input type="password" id="password" name="password" placeholder="Password">
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mb-2">
                                        <label for="confirm-password">Confirm password*</label>
                                        <input type="password" id="confirm-password" name="password_confirmation" placeholder="Confirm password">
                                        @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="button-box">
                                        <div class="login-toggle-btn">
                                            <button class="default-btn floatright" type="submit">Reset password</button>
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











