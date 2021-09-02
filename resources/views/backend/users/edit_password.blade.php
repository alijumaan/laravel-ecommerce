{{--<div class="card shadow mb-4">--}}
{{--    <div class="card-header py-3 d-flex">--}}
{{--        <h5 class="m-0 font-weight-bold text-danger">--}}
{{--            Update password--}}
{{--        </h5>--}}
{{--    </div>--}}
{{--    <div class="card-body">--}}
{{--        <form action="{{ route('admin.users.update_password', $user) }}" method="POST">--}}
{{--            @csrf--}}
{{--            @method('PATCH')--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="current-password" class="text-small text-uppercase">{{ __('Current Password') }}</label>--}}
{{--                        <input id="current-password" type="password"--}}
{{--                               class="form-control form-control-lg"--}}
{{--                               name="current_password"--}}
{{--                               placeholder="Enter your current password">--}}
{{--                        @error('current_password')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="new-password" class="text-small text-uppercase">{{ __('New Password') }}</label>--}}
{{--                        <input id="new-password" type="password"--}}
{{--                               class="form-control form-control-lg"--}}
{{--                               name="password"--}}
{{--                               placeholder="Enter your password">--}}
{{--                        @error('password')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="password-confirm" class="text-small text-uppercase">{{ __('Confirm Password') }}</label>--}}
{{--                        <input id="password-confirm" type="password"--}}
{{--                               class="form-control form-control-lg"--}}
{{--                               name="password_confirmation"--}}
{{--                               placeholder="Confirm Password">--}}
{{--                        @error('password_confirmation')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}


{{--            <div class="form-group pt-4">--}}
{{--                <button class="btn btn-primary" type="submit" name="submit">Update password</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
