<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        if ($guards == "web" && Auth::guard($guards)->check()) {
            return redirect()->route('admin.dashboard');
        }

        if ($guards == "customer" && Auth::guard($guards)->check()) {
            return redirect()->route('profile');
        }

        return $next($request);
    }
}
