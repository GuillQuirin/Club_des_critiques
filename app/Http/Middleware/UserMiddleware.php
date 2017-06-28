<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
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
        if ($request->user()->id_status != 2 || $request->user()->id_status != 3 || $request->user()->id_status != 4)
        {
            return redirect('home');
        }

        return $next($request);
    }
}
