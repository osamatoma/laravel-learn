<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Closure;

class Test
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
        // Log::debug($request->method());
        //echo json_encode(['msg' => 'ss']);
        //$response = $next($request);
        // echo "<h1>global test middleware in each route </h1>";
        //return  $response;
        return $next($request);
 
    }

    public function terminate($request, $response)
    {
        // echo "<h1>middleware after the request has been done</h1>";
    }
}
