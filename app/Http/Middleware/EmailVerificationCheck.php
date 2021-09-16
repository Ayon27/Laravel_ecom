<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationCheck
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
        if (Auth::user() && Auth::user()->email_verified_at == NULL) {
            // $request->session()->flush();
            return redirect()->route('login')
                ->with('message', 'You need to confirm your account. We have sent you an activation link, please check your email.');
        }
        return $next($request);
    }
}
