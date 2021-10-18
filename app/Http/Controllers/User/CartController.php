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
                'stock' => $product->quantity,
            ]
        ]);
        $this->cartUpdateifAuth();
        return response()->json(['msg' => 'success']);
    }

    public function cartUpdateifAuth()
    {
        # code...
        $content = Cart::content();
        $table = 'shoppingcart';

        if (Auth::check()) {
            $userID = Auth::user()->id;

            if (Cart::count() == 0) {
                $this->cartOp->deleteCartFromDatabase($table, $userID);
            } else {
                $this->cartOp->updateCartInDatabase($table, $userID, $content);
            }
        }
        return;
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

    public function deleteCartItem($rowId)
    {
        # code...
        Cart::remove($rowId);
        $this->cartUpdateifAuth();
        return response()->json(['msg' => 'successsful']);
    }

    public function updateItemQty(Request $request, $rowId)
    {
        # code...
        $content = Cart::get($rowId);
        if ($request->property == 1) {
            return $this->increseQty($rowId, $content);
        } else {
            return $this->decreaseQty($rowId, $content);
        }
    }

    public function increseQty($rowId, $content)
    {
        $available_units = $content->options->stock;
        $currentUnits = $content->qty;

        if ($currentUnits < $available_units) {
            $currentUnits++;
            Cart::update($rowId, $currentUnits);
            $this->cartUpdateifAuth();
            return response()->json(['msg' => 'successful']);
        } else
            return response()->json(['msg' => 'Selected quantity unavailable']);
    }

    public function decreaseQty($rowId, $content)
    {
        $content =  Cart::get($rowId);
        $currentUnits = $content->qty;
        if ($currentUnits > 1) {
            $currentUnits--;
            Cart::update($rowId, $currentUnits);
            $this->cartUpdateifAuth();
            return response()->json(['msg' => 'successful']);
        } else
            return response()->json(['msg' => 'Quantity cannot be less than 1']);
    }
}
