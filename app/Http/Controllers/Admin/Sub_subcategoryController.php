<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use Exception;


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
            $categories = Category::where('deleted_at', '=', NULL)->orderBy('category_name_en', 'ASC')->get();
            $subcats = Subcategory::latest()->get();
            $subsubcats =  SubSubCategory::latest()->get();
            $subsubcats_deleted =  SubSubCategory::onlyTrashed()->get();


            return view('admin.category.subsubcategory_index', compact('categories', 'subcats', 'subsubcats', 'subsubcats_deleted'));
        } catch (Exception $e) {
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
            'subsubcategory_name_bn' => 'required|max:200',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ], [
            'subcategory_name_en.required' => 'Subcategory name (English) is required',
            'subcategory_name_bn.required' => 'Subcategory name (Bengali) is required',
            'category_id.required' => 'Please select a category',
            'subcategory_id.required' => 'Please select a category'
        ]);

        try {
            $subsubcategory = new SubSubcategory();

            $subsubcategory->admin_id = Auth::user()->id;
            $subsubcategory->category_id = $request->category_id;
            $subsubcategory->subcategory_id = $request->subcategory_id;
            $subsubcategory->subsubcat_name_en = $request->subcategory_name_en;
            $subsubcategory->subsubcat_name_bn = $request->subcategory_name_en;
            $subsubcategory->subsubcat_slug_en = strtolower(str_replace(' ', '-', $request->subcategory_name_en));
            $subsubcategory->subsubcat_slug_bn = strtolower(str_replace(' ', '-', $request->subcategory_name_bn));
            $subsubcategory->created_at = Carbon::now();

            $this->store($subsubcategory);

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

    public function getSubCategory($category_id)
    {
        $subcats = Subcategory::where('category_id', '=', $category_id)->orderBy('subcat_name_en', 'ASC')->get();

        return json_encode($subcats);
    }
}
