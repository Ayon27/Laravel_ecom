<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VoucherController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin,admin');
        $this->middleware('prevent-back-button');
        $this->middleware('XssSanitizer');
    }
    public function index()
    {

        try {
            $vouchers = Voucher::latest()->get();
            return view('admin.voucher.voucher_index', compact('vouchers'));
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'An error occurred',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function store(Request $request)
    {
        # code...
        $request->validate([
            'voucher_name' => 'required|max:200|unique:vouchers,name',
            'discount' => 'required',
            'validity' => 'required',

        ], [
            'voucher_name.required' => 'Name for the voucher is required',
        ]);
        try {
            Voucher::insert([
                'name' => $request->voucher_name,
                'discount' => $request->discount,
                'validity' => $request->validity,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Successfully added',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed to add voucher',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function delete($id)
    {
        try {
            Voucher::findOrFail($id)->forceDelete();
            $notification = array(
                'message' => 'Successfully Deleted',
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

    public function edit($id)
    {
        # code...
        try {
            $voucher = Voucher::findOrFail($id);
            return view('admin.voucher.voucher_edit', compact('voucher'));
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed. An Error Occurred',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'voucher_name' => 'required|max:200',
            'discount' => 'required',
            'validity' => 'required',

        ], [
            'voucher_name.required' => 'Name for the voucher is required',
        ]);
        try {
            Voucher::findOrFail($request->id)->update([
                'name' => $request->voucher_name,
                'discount' => $request->discount,
                'validity' => $request->validity,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Successfully updated',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed to update voucher',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->route('voucher-index')->with($notification);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $voucher = Voucher::findOrFail($id);

            $voucher->status == 1 ? $stat = 0 : $stat = 1;

            Voucher::findOrFail($id)->update([
                'status' => $stat,
            ]);

            $notification = array(
                'message' => 'Voucher Status Changed Successfully',
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
