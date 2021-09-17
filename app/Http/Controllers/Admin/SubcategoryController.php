<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class SubcategoryController extends Controller
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
        $categories = Category::latest()->orderBy('category_name_en', 'ASC')->get();
        $subcats = Subcategory::latest()->get();
        $subcats_deleted =  Subcategory::onlyTrashed()->latest()->get();


        return view('admin.category.subcategory_index', compact('subcats', 'categories', 'subcats_deleted'));
    }

    /**
     * Show the form for creating a new resource.
     *s
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $request->validate([
            'subcategory_name_en' => 'required|max:200',
            'category_id' => 'required'
        ], [
            'subcategory_name_en.required' => 'Subcategory name (English) is required',
            'category_id.required' => 'Please select a category'
        ]);

        try {
            $subcategory = new Subcategory();

            $subcategory->admin_id = Auth::user()->id;
            $subcategory->category_id = $request->category_id;
            $subcategory->subcat_name_en = $request->subcategory_name_en;
            $subcategory->subcat_slug_en = strtolower(str_replace(' ', '-', $request->subcategory_name_en));
            $subcategory->created_at = Carbon::now();

            $this->store($subcategory);

            $notification = array(
                'message' => 'Successfully added subcategory',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {

            $notification = array(
                'message' => 'Failed to add subcategory',
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
            $category = Category::orderBy('category_name_en', 'ASC')->get();
            $subcategory = Subcategory::findOrFail($id);

            return view('admin.category.subcategory_edit', compact('subcategory', 'category'));
        } catch (Exception $e) {
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
            'subcategory_name_en' => 'required|max:200',
            'category_id' => 'required'

        ], [
            'category_name_en.required' => 'Subcategory name (English) is required',
            'category_id.required' => 'Please select a category'
        ]);

        $id = $request->subcategory_id;

        try {

            Subcategory::find($id)->update([
                'category_id' => $request->category_id,
                'subcat_name_en' => $request->subcategory_name_en,
                'subcat_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Subcategory Updated Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('subcategory.all')->with($notification);
        } catch (Exception $e) {
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
            $subcategory = Subcategory::onlyTrashed()->find($id)->forceDelete();
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
        $sub_subcategoryController =  new Sub_subcategoryController();

        try {
            $sub_subcategoryController->deleteDependantSubcat($id);

            $delete =  Subcategory::find($id)->delete();

            $notification = array(
                'message' => 'Subcategory successfully deleted',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {

            $notification = array(
                'message' => 'Subcategory successfully deleted',
                'alert-type' => 'success'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function restore(Request $request)
    {
        $id = $request->subcategory_restore_id;
        try {
            $subcategory = Subcategory::onlyTrashed()->find($id)->restore();

            $notification = array(
                'message' => 'Subategory successfully restored',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Subategory restoration failed',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function deleteDependant($id)
    {
        $category_id = $id;

        try {
            Subcategory::where('category_id', '=', $category_id)->delete();
            Subcategory::onlyTrashed()->where('category_id', '=', $category_id)->forceDelete();
        } catch (Exception $e) {
        } finally {
            return;
        }
    }
}
