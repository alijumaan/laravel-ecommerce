<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::getFacadeRoot()->current()->uri();
        $route = explode('/', $routeName);

        if (!auth()->check()){
            if ($route[0] == 'admin') {
                return redirect()->route('admin.login');
            }
            return redirect()->route('login');
        }

        if (auth()->user()->isAdminOrSupervisor()) {
            return $next($request);
        }

        return back();
    }
}
