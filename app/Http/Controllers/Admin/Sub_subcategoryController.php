<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use Throwable;

class Sub_subcategoryController extends Controller
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

        try {
            $categories = Category::latest()->orderBy('category_name_en', 'ASC')->get();
            $subcats = Subcategory::latest()->get();
            $subsubcats =  SubSubCategory::with('category', 'subcategory', 'admin')->latest()->get();
            $subsubcats_deleted =  SubSubCategory::onlyTrashed()->with('category', 'subcategory', 'admin')->get();


            return view('admin.category.subsubcategory_index', compact('categories', 'subcats', 'subsubcats', 'subsubcats_deleted'));
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed to load page',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
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
            'subsubcategory_name_en' => 'required|max:200',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ], [
            'subcategory_name_en.required' => 'Sub-subcategory name (English) is required',
            'category_id.required' => 'Please select a category',
            'subcategory_id.required' => 'Please select a subcategory'
        ]);

        try {
            $subsubcategory = new SubSubcategory();

            $subsubcategory->admin_id = Auth::user()->id;
            $subsubcategory->category_id = $request->category_id;
            $subsubcategory->subcategory_id = $request->subcategory_id;
            $subsubcategory->subsubcat_name_en = $request->subsubcategory_name_en;
            $subsubcategory->subsubcat_slug_en = strtolower(str_replace(' ', '-', $request->subsubcategory_name_en));
            $subsubcategory->created_at = Carbon::now();

            $this->store($subsubcategory);

            $notification = array(
                'message' => 'Successfully added Sub-subcategory',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {

            $notification = array(
                'message' => 'Failed to add Sub-subcategory',
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
    public function store($item_to_store)
    {
        //
        $item_to_store->save();

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
            $categories = Category::latest()->orderBy('category_name_en', 'ASC')->get();

            $subsubcat = SubSubcategory::findOrFail($id);

            $subcats = Subcategory::where('category_id', $subsubcat->category_id)->orderBy('subcat_name_en', 'ASC')->get();


            return view('admin.category.subsubcategory_edit', compact('categories', 'subcats', 'subsubcat'));
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Operation Failed',
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
            'subsubcategory_name_en' => 'required|max:200',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ], [
            'subcategory_name_en.required' => 'Sub-subcategory name (English) is required',
            'category_id.required' => 'Please select a category',
            'subcategory_id.required' => 'Please select a subcategory'
        ]);

        $id = $request->subsubcat_id;

        try {

            SubSubcategory::find($id)->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcat_name_en' => $request->subsubcategory_name_en,
                'subsubcat_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Subcategory Updated Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('sub.subcategory.all')->with($notification);
        } catch (\Throwable  $e) {
            $notification = array(
                'message' => 'Failed to Update!',
                'alert-type' => 'error'
            );

            return redirect()->route('subcategory.all')->with($notification);
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
            SubSubcategory::onlyTrashed()->find($id)->forceDelete();

            $notification = array(
                'message' => 'Category deleted permanently',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {

            $notification = array(
                'message' => 'Failed',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function getSubCategory($category_id)
    {
        $subcats = Subcategory::where('category_id', '=', $category_id)->orderBy('subcat_name_en', 'ASC')->get();

        return json_encode($subcats);
    }

    public function getSubSubCategory($subcategory_id)
    {
        $subsubcats = SubSubcategory::where('subcategory_id', '=', $subcategory_id)->orderBy('subsubcat_name_en', 'ASC')->get();

        return json_encode($subsubcats);
    }

    public function delete($id)
    {
        $productController = new ProductController();

        try {
            $productController->DestroyDependant($id, 'subsubcategory_id');

            $delete =  SubSubcategory::find($id)->delete();

            $notification = array(
                'message' => 'Sub-Subcategory successfully deleted',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {

            $notification = array(
                'message' => 'Sub-Subcategory successfully deleted',
                'alert-type' => 'success'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function restore(Request $request)
    {
        $id = $request->subsubcategory_restore_id;
        try {
            SubSubcategory::onlyTrashed()->find($id)->restore();

            $notification = array(
                'message' => 'Sub-Subategory successfully restored',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Sub-Subategory restoration failed',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function deleteDependantSubcat($id)
    {
        $subcategory_id = $id;

        try {
            SubSubcategory::where('subcategory_id', '=', $subcategory_id)->delete();
            SubSubcategory::onlyTrashed()->where('subcategory_id', '=', $subcategory_id)->forceDelete();
        } catch (\Throwable $e) {
        } finally {
            return;
        }
    }

    public function deleteDependantCat($id)
    {
        $category_id = $id;

        try {
            SubSubcategory::where('category_id', '=', $category_id)->delete();
            SubSubcategory::onlyTrashed()->where('category_id', '=', $category_id)->forceDelete();
        } catch (\Throwable $e) {
        } finally {
            return;
        }
    }
}
