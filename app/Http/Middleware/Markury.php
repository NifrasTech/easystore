<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Markury
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
        $content=file_get_contents("marcury.txt");
        if(strtotime($content)>=strtotime(date('Y-m-d'))) 
        {
            return $next($request);
        }
        return response()->view('errors.expired');
        // abort(401);
    }
}
