<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
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
        

        $language = session()->get('locale');
        if($language != $request->segment(1)){
                \Session::put('locale', $request->segment(1));
        }

        if(session()->get('user_token_id') == ""){
            $time_id  = time().rand(10000000,100000000).rand(90000000,100000000);
            \Session::put('user_token_id', $time_id);  
        }

        app()->setlocale($request->segment(1));
        return $next($request);
    }
}
