<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;


class CheckoutWrapperController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:sanctum,web');

        $this->middleware('prevent-back-button');

        $this->middleware('isEmailVerified');
    }

    public function setAndRedir()
    {
        $this->resetCheckout();

        return redirect()->route('checkout');
    }

    public function resetCheckout()
    {
        Session::forget('voucher');

        Session::forget('total');
        Session::forget('shipping');

        $total = intval(Cart::total(2, ".", ""), 10);


        Session::put('total', [
            'total' => $total,
        ]);
        return;
    }
}
