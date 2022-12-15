<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        //dd(Auth::user()->role);
        if (! Auth::user()->hasRole($role)) {
            abort(401, __('translations.checkRoleErrorText'));
        }
        return $next($request);
    }
}
