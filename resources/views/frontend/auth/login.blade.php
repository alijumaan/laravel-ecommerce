@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>login</h2>
                <ul>
                    <li><a href="{{route('front.register.form')}}">register</a></li>
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

                                {!! Form::open(['route' => 'front.login', 'method' => 'post']) !!}

                                <div class="mb-4">
                                    {!! Form::label('username', 'Username *') !!}
                                    {!! Form::text('username', old('username'), ['placeholder' => 'Username']) !!}
                                    @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-3">
                                    {!! Form::label('password', 'Password *') !!}
                                    <input id="pass" type="password" placeholder="Password" name="password">
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
                                    {{--                                    <div class="login-toggle-btn">--}}
                                    {!! Form::button('Login', ['type' => 'submit', 'class' => 'default-btn floatright']) !!}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="form-group mt-2">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <a href="{{ route('front.social_login', 'facebook') }}" class="btn btn-block" style="background-color: #1877F2; color: #FFFFFF">
                                        Login with Facebook
                                    </a>
                                    {{--                                    <a href="{{ route('front.social_login', 'twitter') }}" class="btn btn-block" style="background-color: #1DA1F2; color: #FFFFFF">--}}
                                    {{--                                        Login with Twitter--}}
                                    {{--                                    </a>--}}
                                    {{--                                    <a href="{{ route('front.social_login', 'google') }}" class="btn btn-block" style="border-color: #1877F2; color: black">--}}
                                    {{--                                        Login with Google--}}
                                    {{--                                    </a>--}}
                                </div>
                                {!! Form::close() !!}
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
