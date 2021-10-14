<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;
use Throwable;

class CategoryController extends Controller
{
    //
    public function AllProductsCat($slug)
    {
        try {
            $category = Category::where('category_slug_en', $slug)->select('category_name_en', 'id')->with('subcategory')->first();

            $products = Product::where('category_id', $category->id)->get();

            $title = $category->category_name_en;

            $uniq_colors = $this->getUniqColors($products);
            $uniq_sizes = $this->getUniqSizes($products);

            $flag = 0;

            return view('user.product.multi_product', compact('products', 'category', 'title', 'uniq_colors', 'uniq_sizes', 'flag'));
        } catch (Throwable $e) {
            return abort(404);
        }
    }

    public function AllProductsSubcat($catslug, $subcatSlug)
    {
        try {
            $category = Subcategory::with('category')->where('subcat_slug_en', $subcatSlug)
                ->whereHas('category', function ($q) use ($catslug) {
                    $q->where('category_slug_en', $catslug);
                })->select('subcat_name_en', 'id')->first();
            $products = Product::where('subcategory_id', $category->id)->get();

            $title = $category->subcat_name_en;

            $uniq_colors = $this->getUniqColors($products);
            $uniq_sizes = $this->getUniqSizes($products);

            $flag = 1;

            return view('user.product.multi_product', compact('products', 'category', 'title', 'uniq_colors', 'uniq_sizes', 'flag'));
        } catch (Throwable $e) {
            return abort(404);
        }
    }

    public function AllProductsSubsubcat($catslug, $subcatSlug, $subsubcatSlug)
    {
        try {
            $category = SubSubCategory::with('category', 'subcategory')->where('subsubcat_slug_en', $subsubcatSlug)
                ->whereHas('subcategory', function ($q) use ($subcatSlug) {
                    $q->where('subcat_slug_en', $subcatSlug);
                })->whereHas('category', function ($q2) use ($catslug) {
                    $q2->where('category_slug_en', $catslug);
                })->select('subsubcat_name_en', 'id')->first();
            $products = Product::where('subsubcategory_id', $category->id)->get();

            $title = $category->subsubcat_name_en;

            $uniq_colors = $this->getUniqColors($products);
            $uniq_sizes = $this->getUniqSizes($products);

            $flag = 2;

            return view('user.product.multi_product', compact('products', 'category', 'title', 'uniq_colors', 'uniq_sizes', 'flag'));
        } catch (Throwable $e) {
            return abort(404);
        }
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
