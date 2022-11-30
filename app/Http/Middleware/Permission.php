<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$value)
    {
        if(Auth::user()->role_id==1 || Auth::user()->role_id==2){
            return $next($request);
        }

        if(Auth::user()->checkPermission($value)){
           return $next($request); 
        }  

        if($request->ajax()){
            return response()->json(['message'=>'You are not Authorized to Process this operation','is_success'=>false]);
        }
        abort(401);
    }
}
