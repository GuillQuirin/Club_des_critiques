<?php

namespace App\Http\Middleware;

use App\UserRoom;
use Closure;

class RoomMiddleware
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
        $user_room = UserRoom::where('id_room', $request->route()->parameters('id_room'))->get();
        if ($request->user() === null || (!($user_room->contains('id_user', $request->user()->id))))
        {
            return redirect()->route('home');
        }
        return $next($request);
    }
}