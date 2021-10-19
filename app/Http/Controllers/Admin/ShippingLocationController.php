<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ShippingLocationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin,admin');
        $this->middleware('prevent-back-button');
        $this->middleware('XssSanitizer');
    }

    public function getLoc()
    {
        $divisions = Division::with('districts')->get();

        return view('admin.shipping.shipping_index', compact('divisions'));
    }
    public function addDivision(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|alpha|unique:divisions,division',
            'shipping_charge' => 'required|numeric|digits_between:1,10'
        ], [
            'name.alpha' => 'Only Letters are Accepted',
            'shipping_charge.digits' => 'Only Digits are Accepted'
        ]);

        try {
            Division::insert([
                'division' => $request->name,
                'shipping_charge' => $request->shipping_charge,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Successfully added',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed to add Division',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function addDIstrict(Request $request)
    {
        $request->validate([
            'district_name' => 'required',
            'division_id' => 'required'
        ]);

        try {
            District::insert([
                'division_id' => $request->division_id,
                'district' => $request->district_name,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Successfully added',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed to add District',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function delLoc($name, $id)
    {
        if ($name == 'dist') {
            try {
                District::find($id)->delete();
                $notification = array(
                    'message' => 'District deleted permanently',
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
        } else if ($name == 'div') {
            try {
                Division::find($id)->delete();
                $notification = array(
                    'message' => 'Division deleted permanently',
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
    }

    public function editLoc($name, $id)
    {
        if ($name == 'dist') {
            try {
                $district = District::findOrFail($id);
                $divisions = Division::get();
                return view('admin.shipping.edit_district', compact('district', 'divisions'));
            } catch (\Throwable $e) {
                $notification = array(
                    'message' => 'Failed',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        } else if ($name == 'div') {
            try {
                $division = Division::findOrFail($id);
                return view('admin.shipping.edit_division', compact('division'));
            } catch (\Throwable $e) {
                $notification = array(
                    'message' => 'Failed',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }
    }

    public function updateDIstrict(Request $request)
    {
        $request->validate([
            'name' => 'required|max:250',
            'division_id' => 'required'
        ]);
        $id = $request->id;
        try {
            District::findOrFail($id)->update([
                'division_id' => $request->division_id,
                'district' => $request->name,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Successfully updated',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed to update District',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->route('locations-index')->with($notification);
        }
    }

    public function toggleStatus($name, $id)
    {
        if ($name == 'dist') {
            try {
                $district = District::findOrFail($id);

                $district->status == 1 ? $stat = 0 : $stat = 1;

                District::findOrFail($id)->update([
                    'status' => $stat,
                ]);

                $notification = array(
                    'message' => 'Status Changed Successfully',
                    'alert-type' => 'success'
                );
            } catch (\Throwable $e) {
                $notification = array(
                    'message' => 'Failed. An Error Occurred',
                    'alert-type' => 'error'
                );
            } finally {
                return redirect()->back()->with($notification);
            }
        } else if ($name == 'div') {
            try {
                $division = Division::findOrFail($id);

                $division->status == 1 ? $stat = 0 : $stat = 1;

                Division::findOrFail($id)->update([
                    'status' => $stat,
                ]);
                District::where('division_id', $id)->update([
                    'status' => $stat,
                ]);
                $notification = array(
                    'message' => 'Status Changed Successfully',
                    'alert-type' => 'success'
                );
            } catch (\Throwable $e) {
                $notification = array(
                    'message' => 'Failed. An Error Occurred',
                    'alert-type' => 'error'
                );
            } finally {
                return redirect()->back()->with($notification);
            }
        }
    }

    public function updateDivision(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha|max:250',
            'id' => 'required',
            'shipping_charge' => 'required|numeric|digits_between:1,10'
        ], [
            'name.alpha' => 'Only Letters are Accepted',
            'shipping_charge.digits' => 'Only Digits are Accepted'
        ]);
        try {
            Division::findOrFail($request->id)->update([
                'division' => $request->name,
                'shipping_charge' => $request->shipping_charge,
            ]);
            $notification = array(
                'message' => 'Successfully updated',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed to update Division',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->route('locations-index')->with($notification);
        }
    }
}
