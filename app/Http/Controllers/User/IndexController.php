<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //

    public function index()
    {
        return view('user.index');
    }

    public function loginRedir()
    {
        // return redirect()->route('home');
        return view('dashboard');
    }
}
