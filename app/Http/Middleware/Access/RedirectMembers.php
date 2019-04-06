<?php

namespace App\Http\Middleware\Access;

use Closure;
use App\User;
class RedirectMembers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->user()){

        } else {
            // dd($request->user()->with('roles'));
            if(!$request->user()->roles->contains('role','Super Admin') && !$request->user()->roles->contains('role','Admin')){
                return redirect(route('page.events'));
            }
        }

        return $next($request);
    }
}
