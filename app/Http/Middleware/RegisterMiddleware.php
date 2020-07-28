<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class RegisterMiddleware
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
        $now = Carbon::now('America/Mexico_City');
        $dt = $now->toArray();
        $open = true;
        if ($dt["dayOfWeek"] == 0)
        {
            $open = false;
        }
        if ($dt["hour"] < 9 || $dt["hour"]>15){
            $open = false;
        }
        // if (!$open)
        // {
        //     return redirect('/notopen');
        // }
        if (session('unit')){
            return $next($request);
        }
        return redirect('/register');
    }
}
