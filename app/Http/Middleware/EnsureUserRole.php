<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class EnsureUserRole
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
        $user = Auth::user();
        //jika yang login bukan sama dengan admin atau user bukan admin maka
        if(($role == 'admin' && !$user->is_admin) || ($role == 'user' && $user->is_admin)){

            //muncul pesan ini
            abort(403);
        }
        return $next($request);
    }
}
