<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\Sub_subcategoryController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin,admin');
        $this->middleware('prevent-back-button');
        $this->middleware('XssSanitizer');
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

        $categories_deleted =  Category::onlyTrashed()->latest()->get();

        return view('admin.category.category_index', compact('categories', 'categories_deleted'));
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
            'category_name_en' => 'required|max:200',
            'category_name_bn' => 'required|max:200',
        ], [
            'category_name_en.required' => 'Category name (English) is required',
            'category_name_bn.required' => 'Category name (Bengali) is required',
        ]);


        try {

            $category = new Category();

            $category->admin_id = Auth::user()->id;
            $category->category_name_en = $request->category_name_en;
            $category->category_name_bn = $request->category_name_bn;
            $category->category_slug_en = strtolower(str_replace(' ', '-', $request->category_name_en));
            $category->category_slug_bn = strtolower(str_replace(' ', '-', $request->category_name_bn));
            $category->created_at = Carbon::now();
            $this->store($category);

            $notification = array(
                'message' => 'Successfully added',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Failed to add category',
                'alert-type' => 'error'
            );
        } finally {
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
        try {
            $category = Category::findOrFail($id);
            return view('admin.category.category_edit', compact('category'));
        } catch (Exception $e) {
            $notification = array(
                'message' => 'An eror occurred',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'category_name_en' => 'required|max:200',
            'category_name_bn' => 'required|max:200',
        ], [
            'category_name_en.required' => 'Category name (English) is required',
            'category_name_bn.required' => 'Category name (Bengali) is required',
        ]);

        $id = $request->category_id;

        try {

            Category::find($id)->update([
                'category_name_en' => $request->category_name_en,
                'category_name_bn' => $request->category_name_bn,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_slug_bn' => strtolower(str_replace(' ', '-', $request->category_name_bn)),
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Category Updated Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('category.all')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Failed to Update!',
                'alert-type' => 'error'
            );

            return redirect()->route('category.all')->with($notification);
        }
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


        try {
            $category = Category::onlyTrashed()->find($id)->forceDelete();
            $notification = array(
                'message' => 'Category deleted permanently',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Failed',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function delete($id)
    {
        $subcategoryController =  new SubcategoryController();
        $sub_subcategoryController =  new Sub_subcategoryController();
        try {

            $sub_subcategoryController->deleteDependantCat($id);
            $subcategoryController->deleteDependant($id);


            $delete =  Category::find($id)->delete();

            $notification = array(
                'message' => 'Category successfully deleted',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {

            $notification = array(
                'message' => 'Category successfully deleted',
                'alert-type' => 'success'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function restore(Request $request)
    {
        $id = $request->category_restore_id;
        try {
            $category = Category::onlyTrashed()->find($id)->restore();

            $notification = array(
                'message' => 'Category successfully restored',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Category restoration failed',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }
}
