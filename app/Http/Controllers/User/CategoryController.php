<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function AllProducts($slug)
    {
        $category = Category::where('category_slug_en', $slug)->select('category_name_en', 'id')->first();

        $products = Product::where('category_id', $category->id)->paginate(20);

        $title = $category->category_name_en;
        // $product_color = array();

        // foreach ($products as $item) {
        //     // $product_color = explode(',', $item->product_color_en);
        //     echo $item->product_color_en;
        // }

        // print_r($product_color);
        return view('user.product.multi_product', compact('products', 'category', 'title'));
    }
}
