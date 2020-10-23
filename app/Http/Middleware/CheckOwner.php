<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckOwner
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

        //jesli aktualnie zalogowany user ma role: admin -> przejdz do nast requestu
        if(Auth::user()->hasRole(['admin']))
            return $next($request);
        else
            return redirect('/');   //przekieruj do strony glownej //lek 37 5:22 skonczylem
    }
}
