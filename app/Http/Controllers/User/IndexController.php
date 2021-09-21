<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('isEmailVerified');
    }

    public function index()
    {
        $carousels = Carousel::latest()->where('status', 1)->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products_latest = Product::select(
            'category_id',
            'product_name_en',
            'product_slug_en',
            'product_thumbnail',
            'product_actual_price',
            'product_discount_price',
            'featured',
            'offer'
        )->latest()->where('status', 1)->limit(15)->get();

        $products_featured = $products_latest->filter(function ($item) {
            return $item['featured'] == 1;
        })->slice(0, 8)->values();

        return view('user.index', compact('carousels', 'categories', 'products_latest', 'products_featured'));
    }

    public function loginRedir()
    {
        return redirect()->route('home');
    }

    public function password_reset_redir()
    {
        $message = 'An email has been sent to your';
        return view('user.password-reset-redir', compact('message'));
    }
}
