<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ShippingLocationController extends Controller
{
    //
    public function getLoc()
    {
        $divisions = Division::with('districts')->get();

        return view('admin.shipping.shipping_index', compact('divisions'));
    }
    public function addDivision(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|alpha|unique:divisions,division',
            'shipping_charge' => 'required|numeric|max:10'
        ], [
            'name.alpha' => 'Only Letters are Accepted',
            'shipping_charge.digits' => 'Only Digits are Accepted'
        ]);

        // try {
        Division::insert([
            'division' => $request->name,
            'shipping charge' => $request->shipping_charge,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Successfully added',
            'alert-type' => 'success'
        );
        // } catch (\Throwable $e) {
        //     $notification = array(
        //         'message' => 'Failed to add Division',
        //         'alert-type' => 'error'
        //     );
        // } finally {
        //     return redirect()->back()->with($notification);
        // }
    }
}
