@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <div class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>login</h2>
                <ul>
                    <li><a href="{{route('register')}}">register</a></li>
                    <li> login </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- login-area start -->
    <div id="login-form" class="register-area ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="form-group">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="username">Username*</label>
                                        <input type="text" name="username" value="{{ old('username') }}" placeholder="Username">
                                        @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password">Password*</label>
                                        <input id="pass" type="password" name="password" placeholder="password">
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <label class="show">Show password</label>
                                    <label class="hide"></label>
                                    <div class="form-group row mb-0">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="button-box">
                                        <button class="default-btn floatright">{{ __('Login') }}</button>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    <div class="form-group mt-4 mb-0">
                                        <a href="{{ route('social_login', 'facebook') }}" class="btn btn-block" style="background-color: #1877F2; color: #FFFFFF">
                                            Login with Facebook
                                        </a>
{{--                                    <a href="{{ route('social_login', 'twitter') }}" class="btn btn-block" style="background-color: #1DA1F2; color: #FFFFFF">--}}
{{--                                        Login with Twitter--}}
{{--                                    </a>--}}
{{--                                    <a href="{{ route('social_login', 'google') }}" class="btn btn-block" style="border-color: #1877F2; color: black">--}}
{{--                                        Login with Google--}}
{{--                                    </a>--}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login-area end -->
@endsection

@section('script')
    <script>

        $('.show').click(function (){
            $(this).text('')
            $(':password').attr('type', 'text')
            $('.hide').text('Hide password')
        });

        $('.hide').click(function (){
            $(this).text('');
            $('#pass').attr('type', 'password')
            $('.show').text('Show password')
        });

    </script>

    {{--    <script>--}}
    {{--        let vm = new Vue({--}}
    {{--            el: "#login-form",--}}
    {{--            data: {--}}
    {{--                fieldType: "password",--}}
    {{--            },--}}
    {{--            methods: {--}}
    {{--                switchField() {--}}
    {{--                    this.fieldType = this.fieldType === "password" ? "text" : "password";--}}
    {{--                }--}}
    {{--            },--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection
