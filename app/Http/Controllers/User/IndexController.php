<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('isEmailVerified');
    }

    public function index()
    {
        return view('user.index');
    }

    public function loginRedir()
    {
        return redirect()->route('home');
    }

    public function password_reset_redir()
    {
        $message = 'An email has been sent to your';
        return view('user.password-reset-redir', compact('message'));
    }
}
