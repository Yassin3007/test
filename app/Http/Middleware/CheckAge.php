<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

 ;

class CheckAge
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
        
        $x = Auth('web')-> user();
        if($x   < 1){
            return redirect() ->route('blog') ;
        }
 
       
        return $next($request);
    }
}
