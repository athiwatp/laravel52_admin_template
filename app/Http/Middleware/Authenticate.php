<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->input('api_token');

        if ( Auth::guard($guard)->guest() ) {
            if ( $request->ajax() || $request->wantsJson() ) {

                // @TODO: Here we should be able to check the guests using token
                if (empty($token)) {
                    return response('Unauthorized.', 401);
                }

            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
