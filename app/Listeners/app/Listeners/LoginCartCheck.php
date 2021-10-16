<?php

namespace App\Listeners\app\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\user\cartOperationsController;
use Throwable;
use Illuminate\Support\Facades\DB;

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

        $userID = Auth::user()->id;
        $cartOp = new cartOperationsController();

        if (Session::has('cart')) {
            if ($this->mergeAndUpsert($cartOp, $userID)) {
            } else {
                $this->addCartToDatabase($userID);
            }
        } else Cart::restore($userID);
    }

    public function addCartToDatabase($userID)
    {
        # code...
        try {
            Cart::store($userID);
            return;
        } catch (Throwable $e) {
            return redirect()->back()->with($e);
        }
    }

    public function mergeAndUpsert(cartOperationsController $cartOp, $userID)
    {
        try {
            if (DB::table('shoppingcart')->where('identifier', $userID)->exists()) {
                Cart::instance('default')->merge($userID);
                $cartOp->upsertCartInDatabase('shoppingcart', $userID, Cart::content());
                return true;
            } else return false;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
}
