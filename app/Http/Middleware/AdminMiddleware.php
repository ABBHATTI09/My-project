<?php

namespace App\Http\Middleware;

use Closure;
use session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // dd('AdminMiddleware executed.');
      // dd(session()->all());

        if ( session('user_role_id') != '1') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
        return $next($request);

    
    }
}
