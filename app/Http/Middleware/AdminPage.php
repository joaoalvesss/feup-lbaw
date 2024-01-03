<?php

namespace App\Http\Middleware;

use Closure;

class AdminPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request,Closure $next)
    {
        if($request->route('user')->hasRole('Admin')){
            abort(404, 'Not Found');
        }

        return $next($request);
    }
}
