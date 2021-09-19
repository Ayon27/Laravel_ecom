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
            $product = Product::where([['product_slug_en', '=', $slug], ['status', '=', '1']])->first();
            $product_id = $product->id;

            return view('user.product.product_details', compact('product'));
        } catch (Exception $e) {
            return abort(404);
        }
    }
}
