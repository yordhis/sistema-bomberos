<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        
        if (!$request->expectsJson()) {
            // return '/login';
            return route('login.index');
        }
    }

    // public function handle(Request $request, Closure $next): Response
    // {
    //     if ($request->input('usu_nombre') !== 'admin') {
    //         return redirect('login');
    //     }
 
    //     return $next($request);
    // }
}
