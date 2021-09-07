<?php

namespace App\HTTP\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // return $request->wantsJson()
        //     ? response()->json(['two_factor' => false])
        //     : redirect()->intended('admin/dashboard');

        if (Auth::guard('admin')->check())
            return redirect()->intended('admin/dashboard');
        else if (Auth::guard('user')->check())
            return redirect()->intended(route('home'));
    }
}
