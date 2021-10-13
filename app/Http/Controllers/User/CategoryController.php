<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function AllProducts($slug)
    {
        $category = Category::where('category_slug_en', $slug)->select('category_name_en', 'id')->with('subcategory')->first();

        $products = Product::where('category_id', $category->id)->get();

        $title = $category->category_name_en;

        $uniq_colors = $this->getUniqColors($products);
        $uniq_sizes = $this->getUniqSizes($products);

        return view('user.product.multi_product', compact('products', 'category', 'title', 'uniq_colors', 'uniq_sizes'));
    }

    public function getUniqColors($products)
    {
        $product_color = array();

        foreach ($products as $item) {
            if (str_contains($item->product_color_en, ',')) {
                $product_color =  array_merge($product_color, explode(',', $item->product_color_en));
            } else {
                array_push($product_color, $item->product_color_en);
            }
        }

        $uniq_colors = array_unique($product_color);
        $uniq_colors = $this->sortArray($uniq_colors);

        return $uniq_colors;
    }

    public function getUniqSizes($products)
    {
        $product_size = array();

        foreach ($products as $item) {
            if (str_contains($item->product_size_en, ',')) {
                $product_size = array_merge($product_size, explode(',', $item->product_size_en));
            } else {
                array_push($product_size, $item->product_size_en);
            }
        }
        $uniq_sizes = array_unique($product_size);
        $uniq_sizes = $this->sortArray($uniq_sizes);

        return $uniq_sizes;
    }

    public function sortArray($array)
    {
        sort($array);
        return $array;
    }
}
