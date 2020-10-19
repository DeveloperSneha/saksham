<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        switch ($guard) {
            case 'mentor':
                if (Auth::guard($guard)->check()) {
                    return redirect('/mentor');
                }
                break;
            case 'candidate':
                if (Auth::guard($guard)->check()) {
                    return redirect('/candidate');
                }
                break;
            case 'company':
                if (Auth::guard($guard)->check()) {
                    return redirect('/company');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/admin');
                }
                break;
        }
        return $next($request);
    }

}