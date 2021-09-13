<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin,admin');
        $this->middleware('prevent-back-button');
        $this->middleware('XssSanitizer');
    }


    public function AddProduct()
    {
        try {
            $categories = Category::latest()->get();

            return view('admin.product.product_add', compact('categories'));
        } catch (Exception $e) {
            $notification = array(
                'message' => 'An Error Occurred!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
