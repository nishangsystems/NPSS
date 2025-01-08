<?php

namespace App\Http\Middleware;

use App\Validity;
use Closure;
use Illuminate\Http\Request;

class LicenseValidity
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
        if(($validity = Validity::first()) != null){
            if($validity->status == 0){
                auth('user')->logout();
                session()->flush();
                return redirect(route('license_expired'));
            }
        }
        return $next($request);
    }
}
