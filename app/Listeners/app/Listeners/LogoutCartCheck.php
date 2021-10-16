<?php

namespace App\Listeners\app\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Throwable;

class LogoutCartCheck
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
     * @param  object  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $this->addCartToDatabase();
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
