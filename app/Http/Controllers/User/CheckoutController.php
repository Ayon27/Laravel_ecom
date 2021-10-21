<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum,web');

        $this->middleware('prevent-back-button');

        $this->middleware('isEmailVerified');
        // $this->resetCheckout();

        $this->deleteVoucher(true);
    }
    public function checkout()
    {
        if (Cart::total() <= 0) {
            $notification = array(
                'message' => 'Nothing in Cart. Please add some product first',
                'alert-type' => 'error',
            );
            return redirect()->route('home')->with($notification);
        } else {
            $content = Cart::content();
            $qty = Cart::count();
            $subtotal = Cart::priceTotal();
            $total = Cart::total();

            $user = User::select('name', 'email', 'phone')->find(Auth::user()->id);
            $division = Division::orderBy('division', 'ASC')->get();

            return view('user.checkout', compact('content', 'qty', 'subtotal', 'total', 'user', 'division'));
        }
    }

    public function getDistList($id)
    {
        $district = District::where('division_id', $id)->get();
        $delivery = Division::select('shipping_charge')->where('id', $id)->first();
        Session::put('shipping', ['charge' => $delivery->shipping_charge]);
        $total = intval(Cart::total(2, ".", ""), 10);

        if (Session::has('voucher')) {
            $data = session()->get('voucher');
            $data2 = $data['discountAmt'];
            $intDiscount = intval($data2, 10);
            Session::put('total', [
                'total' => $total + $delivery->shipping_charge - $intDiscount,
            ]);
        } else {
            Session::put('total', [
                'total' => $total + $delivery->shipping_charge,
            ]);
        }
        return  response()->json(['district' => $district, 'shipping' => $delivery]);
    }

    public function applyVoucher(Request $request)
    {
        if (Session::has('voucher')) {
            return response()->json(['message' => 'Voucher already applied']);
        } else {
            $voucher = Voucher::where('name', $request->name)->where('validity', '>=', Carbon::now()->format('Y-m-d'))->where('status', 1)->first();

            if ($voucher) {

                $total = intval(Cart::total(2, ".", ""), 10);
                $discountAmt = floor($total * ($voucher->discount / 100));

                Session::put('voucher', [
                    'name' => $voucher->name,
                    'discount' => $voucher->discount,
                    'discountAmt' => $discountAmt,
                    // 'newTotal' => $total - $discountAmt,
                ]);

                if (Session::has('total')) {
                    $data = session()->get('total');
                    $data2 = $data['total'];
                    $newtotal = intval($data2, 10);
                    Session::put('total', [
                        'total' => $newtotal - $discountAmt,
                    ]);
                }

                return response()->json(['status' => 'success', 'message' => 'Voucher ' . $voucher->name . '(-' . $voucher->discount . '%) applied successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'This voucher does not exist or has expired!']);
            }
        }
    }

    public function deleteVoucher($controller = false)
    {
        if (!$controller)
            $this->deleteVoucherAmount();
        Session::forget('voucher');
        return response()->json(['message' => 'Voucher removed']);
    }

    public function deleteVoucherAmount()
    {
        $data = session()->get('voucher');
        $data2 = $data['discountAmt'];
        $intDiscount = intval($data2, 10);

        if (Session::has('total')) {
            $totalData = session()->get('total');
            $totalData2 = $totalData['total'];
            $total = intval($totalData2, 10);


            Session::put('total', [
                'total' => $total +  $intDiscount,
            ]);
        }
        return;
    }

    public function resetCheckout()
    {
        // Session::forget('total');

        $total = intval(Cart::total(2, ".", ""), 10);


        Session::put('total', [
            'total' => $total,
        ]);
        return;
    }
}
