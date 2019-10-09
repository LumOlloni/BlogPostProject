<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Response;

class Admin
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
        if ($request->user() && $request->user()->role_id == 2) {
            return $next($request);
        }
        else {
            // return new Response(view('unauthorized'));
            return  abort(404);
        }
    }
}
