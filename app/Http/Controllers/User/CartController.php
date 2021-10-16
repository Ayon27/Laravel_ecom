<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\user\cartOperationsController;
use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public $cartOp;

    public function __construct()
    {
        $this->cartOp = new cartOperationsController();
    }

    public function addToCart(Request $request, $productID)
    {
        $product = $this->getProductDetails($productID);
        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name_en,
            'qty' => $request->quantity,
            'price' => $product->product_discount_price,
            'weight' => 1,
            'options' => [
                'image' => $product->product_thumbnail,
                'color' => $request->color,
                'size' => $request->size,
            ]
        ]);

        $content = Cart::content();
        if (Auth::check()) {
            $userID = Auth::user()->id;

            $this->cartOp->updateCartInDatabase('shoppingcart', $userID, $content);
            // Cart::store($userID);
            // Cart::instance('default')->store($userID);

        }
        return response()->json(['msg' => 'success']);
    }

    public function loadMinicart()
    {
        $cartContent = Cart::content();
        $qty = Cart::count();
        $total = Cart::total();

        return response()->json(array(
            'cartContent' => $cartContent,
            'qty' => $qty,
            'total' => $total
        ));
    }

    public function getProductDetails($productID)
    {
        try {
            return Product::findOrFail($productID);;
        } catch (Throwable $e) {
            $notification = array(
                'message' => 'An Error Occurred',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
