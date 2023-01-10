<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $user = User::whereApi_token(trim($request->bearerToken()))->whereLevel("admin")->first();
        
       
      
        if(!$user)
        return  response([
            "data"=>"You don't authority to access panel admin ",
      
            "statuzs" =>403
         ],403);


        return $next($request);
        
    }
}
