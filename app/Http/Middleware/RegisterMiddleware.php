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
        $open = explode(':', env('OPEN_TIME', "9:00"));
        if (sizeof($open) < 2){
            $open[1] = 0;
        }
        $closed = explode(':', env('CLOSE_TIME', "4:00"));
        if (sizeof($closed) < 2){
            $closed[1] = 0;
        }        
        $days = str_getcsv(env('DAYS_OPEN', '0,1,2,3,4,5,6'));

        $isOpen = false;
        $now = Carbon::now('America/Mexico_City');
        if (in_array($now->dayOfWeek, $days)){
            $isOpen = true;
            $openTime = Carbon::now('America/Mexico_City');
            $openTime->hour = $open[0];
            $openTime->minute = $open[1];
            $openTime->second = 0;
            $closeTime = Carbon::now('America/Mexico_City');
            $closeTime->hour = $closed[0];
            $closeTime->minute = $closed[1];
            if ($now < $openTime || $now > $closeTime){
                $isOpen = false;
            }
        }
              
        if (!$isOpen)
        {
            return redirect('/notopen');
        }
        if (session('unit')){
            return $next($request);
        }
        return redirect('/register');
    }
}
