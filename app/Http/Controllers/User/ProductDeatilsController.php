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
            $category_id = $product->category_id;

            $colors = $product->product_color_en;
            $product_color_en = explode(',', $colors);

            $sizes = $product->product_size_en;
            $product_size_en = explode(',', $sizes);

            $related_products = Product::where('category_id', $category_id)->orderBy('id', 'DESC')->limit(8)->get();

            return view('user.product.product_details', compact('product', 'product_color_en', 'product_size_en', 'related_products'));
        } catch (Exception $e) {
            return abort(404);
        }
    }
}
