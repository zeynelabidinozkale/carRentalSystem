<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if (!auth()->user()->role->panelLogin) {
                return $next($request);
            }
        }
        return redirect(route('home'))->with('error','Bu sayfaya giriş izniniz bulunmamaktadır.');
    }
}
