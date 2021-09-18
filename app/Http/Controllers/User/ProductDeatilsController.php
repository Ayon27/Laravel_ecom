<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductDeatilsController extends Controller
{
    //
    public function ShowProduct($slug)
    {
        try {
            $product = Product::where('product_slug_en', '=', $slug)->first();
            $product_id = $product->id;
            $prod_imgs = ProductImage::where('product_id', $product_id)->get();
            return view('user.product.product_details', compact('product', 'prod_imgs'));
        } catch (Exception $e) {
            $notification = array(
                'message' => 'An Unexpected Error Occurred',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
