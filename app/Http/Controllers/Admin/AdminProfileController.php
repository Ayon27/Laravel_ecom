<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Hash;

class AdminProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin,admin');
        $this->middleware('prevent-back-button');
        $this->middleware('XssSanitizer');
    }


    public function index()
    {
        $admin = Admin::find(1);
        return view('admin.profile', compact('admin'));
    }

    public function edit()
    {
        $admin = Admin::find(1);
        return view('admin.editProfile', compact('admin'));
    }



    public function update(Request $request)
    {
        $request->validate([
            'image' => 'mimes:png,jpg,jpeg|image|max:5000'
        ]);

        $admin = Admin::find(1);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->updated_at = Carbon::now();

        if ($request->file('image')) {
            if ($admin->profile_photo_path != NULL)
                unlink(public_path($admin->profile_photo_path));

            $image = $request->file('image');
            $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save(public_path('/uploads/profile-photos/') . $img_name);
            $img_loc = 'uploads/profile-photos/' . $img_name;
            $admin->profile_photo_path = $img_loc;
        }

        $admin->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword()
    {
        return view('admin.change_password');
    }

    public function updatePassword(Request $request)
    {
        $validatedInputs = $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'new_password_confirm' => 'required|same:new_password'
        ], [
            'current_password.min' => 'The current password is incorrect',
            'new_password.min' => 'Password must contain 8 characters',
            'new_password_confirm.same' => 'The passwords do not match'
        ]);

        $hashedPass = Admin::find(1)->password;
        if (Hash::check($request->current_password, $hashedPass) && $request->new_password === $request->new_password_confirm) {
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->new_password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        } else {
            return redirect()->back();
        }
    }
}
