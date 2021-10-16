<?php

namespace App\Listeners\app\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\user\cartOperationsController;
use Throwable;

class LoginCartCheck
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //
        // return abort(404);
        if (Session::has('cart')) {
            $this->addCartToDatabase();
        }
        $cartOp = new cartOperationsController();

        $userID = Auth::user()->id;

        Cart::restore($userID);
    }

    public function addCartToDatabase()
    {
        # code...
        $userID = Auth::user()->id;
        try {
            Cart::store($userID);
            return;
        } catch (Throwable $e) {
            return redirect()->back()->with($e);
        }
    }
}
