<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\SubscriptionFormDetail;
use Auth;
use App\Models\ShareDetails;

class IsPaymentReceived
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
        // dd(!empty(auth()->user()->id));
        // if(!empty($request->route('id'))){
        //     $share = ShareDetails::find($id);
        //     if($share->copy_to_our_research == 1){
        //         return $next($request);
        //     }else{

        //     }
        // }
        $SubscriptionFormDetailCount = SubscriptionFormDetail::where('user_id',auth()->user()->id)->where('is_payment_received',1)->first();
        if(empty($SubscriptionFormDetailCount)){
            return redirect()->route('frontend.research-dashboard'); 
        }
        return $next($request);
    }
}
