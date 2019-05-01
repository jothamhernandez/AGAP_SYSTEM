<?php

namespace App\Http\Middleware\Access;

use Closure;

class VerifiedAndComplete
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
        if($request->user()->info->first_name == null || $request->user()->info->last_name == null || $request->user()->info->agency_id == 0){
            return redirect(route('page.account_info'))->with(['message'=>'Please Complete Form and Verify Your Email','class'=>'danger']);
        }

        return $next($request);
    }
}
