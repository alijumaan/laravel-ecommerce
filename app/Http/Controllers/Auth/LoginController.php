<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as protected originalLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    public function redirectTo()
    {
        if (auth()->user()->isAdminOrSupervisor()) {
            return $this->redirectTo = '/admin';
        }
    }

    public function logout(Request $request)
    {
        $cart = collect($request->session()->get('cart'));

        /* Call Original Logout Method */
        $response = $this->originalLogout($request);

        /* Repopulate Session With Cart */
        if (!config('cart.destroy_on_logout')) {
            $cart->each(function ($rows, $identifier) use ($request) {
                $request->session()->put('cart.' . $identifier, $rows);
            });
        }

        /* Repopulate Original Response  */
        return $response;
    }

    /* Actions After Logged Out  */
    protected function loggedOut(Request $request)
    {
        Cache::forget('admin_side_menu');
        Cache::forget('shop_categories_menu');
        Cache::forget('shop_tags_menu');
    }

    // Facebook Function to Log in
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Facebook Function to Log in
    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $id = $socialUser->getId();
        $token = $socialUser->token;
        $nickName = $socialUser->getNickname();
        $name = $socialUser->getName();
        $email = $socialUser->getEmail() == '' ? trim(Str::lower(Str::replaceArray(' ', ['_'], $name))) . '@' . $provider . '.com' : $socialUser->getEmail();
        $user_image = $socialUser->getAvatar();

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'first_name' => $name,
                'last_name' => $name,
                'username' => $nickName != '' ? $nickName : trim(Str::lower(Str::replaceArray(' ', ['_'], $name))),
                'email' => $email,
                'email_verified_at' => Carbon::now(),
                'phone' => null,
                'status' => 1,
                'receive_email' => 1,
                'remember_token' => $token,
                'password' => Hash::make($email),
            ]
        );

        $user->assignRole('user');

        Auth::login($user, true);

        return redirect()->route('user.dashboard')->with([
            'message' => 'Your logged in successfully',
            'alert-type' => 'success',
        ]);
    }
}
