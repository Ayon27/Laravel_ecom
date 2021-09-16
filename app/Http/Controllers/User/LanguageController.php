<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    //

    public function English()
    {
        session()->get('lang');
        session()->forget('lang');
        Session::put('lang', 'en');

        return redirect()->back();
    }

    public function Bengali()
    {
        session()->get('lang');
        session()->forget('lang');
        Session::put('lang', 'bn');

        return redirect()->back();
    }
}
