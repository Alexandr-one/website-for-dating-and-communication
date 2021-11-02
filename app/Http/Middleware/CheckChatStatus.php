<?php

namespace App\Http\Middleware;

use App\Classes\ChatUserStatusEnum;
use App\Classes\UserStatusEnum;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckChatStatus
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
        $user_sec = User::find(preg_split('[/]', url()->current())[5]);
        $userChats = Auth::user()->chat()->find($user_sec->id);

        if($userChats)
            if($userChats->pivot->status == ChatUserStatusEnum::DELETE){
                return redirect()->route('index');
            }
        return $next($request);
    }
}
