<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IsSubscriptionExpired
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
        $currentDate = Carbon::now();
        $subscription_end_Date = auth()->user()->subscription_end_date;
        
        $date1 = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString());
        
        $date2 = Carbon::createFromFormat('Y-m-d',Carbon::parse(auth()->user()->subscription_end_date)->format('Y-m-d'));
        
        if($date1->gt($date2)){
            $difference_days = $date2->diffInDays($date1);

            if($difference_days > 15){
                return redirect()->route('frontend.subscriptionExpire');
            }
            else{
                return $next($request);
            }

        }
        else{
            return $next($request);
        }
        return $next($request);
        
    }
}
