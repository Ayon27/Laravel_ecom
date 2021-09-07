<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Image;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin,admin');
        $this->middleware('prevent-back-button');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $categories = Category::latest()->get();

        return view('admin.category.category_index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $request->validate([
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5000',
        ], [
            'image.image' => 'The icon must be an image of type .png/.jpg/.jpeg'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $img_name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(100, 100)->save(public_path('/uploads/category_icons/') . $img_name_gen);
            $img_loc = 'uploads/category_icons/' . $img_name_gen;
        }

        try {

            $category = new Category();

            $category->category_name_en = $request->category_name_en;
            $category->category_name_bn = $request->category_name_bn;
            $category->category_slug_en = strtolower(str_replace(' ', '-', $request->category_name_en));
            $category->category_slug_bn = strtolower(str_replace(' ', '-', $request->category_name_bn));
            $category->category_icon = $img_loc;
            $category->created_at = Carbon::now();
            $this->store($category);

            $notification = array(
                'message' => 'Successfully added',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Failed to add category',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($obj_to_store)
    {
        //
        $obj_to_store->save();

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
