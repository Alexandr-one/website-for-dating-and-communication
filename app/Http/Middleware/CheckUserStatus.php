<?php

namespace App\Http\Middleware;

use App\Classes\UserStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
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
        if(Auth::user()->status != UserStatusEnum::ACTIVE)
        {
            if(Auth::user()->status != UserStatusEnum::ADMIN)
            {
                return redirect(route('verify'));
            }
            if(Auth::user()->status == UserStatusEnum::ADMIN)
                return $next($request);
        }

        return $next($request);
    }
}
