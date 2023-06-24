<?php

namespace App\Http\Middleware;

use App\Models\Closing;
use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegisterMiddleware
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
        $open = explode(':', env('OPEN_TIME', "9:00"));
        if (sizeof($open) < 2) {
            $open[1] = 0;
        }
        $closed = explode(':', env('CLOSE_TIME', "16:00"));
        if (sizeof($closed) < 2) {
            $closed[1] = 0;
        }
        if ($closed[0] < 12) {
            $closed[0] += 12;
        }
        $days = str_getcsv(env('DAYS_OPEN', '0,1,2,3,4,5,6'));

        $isOpen = false;
        // $now = Carbon::now('America/Mexico_City');
        $now = Carbon::now('-6:00');

        if (in_array($now->dayOfWeek, $days)) {
            $isOpen = true;
            // $openTime = Carbon::now('America/Mexico_City');
            $openTime = Carbon::now('-6:00');
            $openTime->hour = $open[0];
            $openTime->minute = $open[1];
            $openTime->second = 0;
            $closeTime = Carbon::now('-6:00');
            // $closeTime = Carbon::now('America/Mexico_City');
            $closeTime->hour = $closed[0];
            $closeTime->minute = $closed[1];
            if ($now < $openTime || $now > $closeTime) {
                $isOpen = false;
            }
        }

        $now->hour = 0;
        $now->minute = 0;
        $now->second = 0;
        $closing = Closing::where('close_on', '=', $now)->first();
        // dd($now);
        if ($closing){
            $isOpen = false;
        }

        if (!$isOpen) {
            return redirect('/notopen');
        }
        if (session('unit')) {
            return $next($request);
        }
        return redirect('/register');
    }
}
