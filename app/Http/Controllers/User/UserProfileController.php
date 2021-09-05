<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Image;
use Illuminate\Validation\Rule;
use Hash;
use Session;

class UserProfileController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:sanctum,web');

        $this->middleware('prevent-back-button');
    }

    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('user.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = User::find(Auth::user()->id);
        return view('user.profile-edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        $validated_data = $request->validate([
            'name' => 'required|max: 30|regex:/^[a-zA-Z\s]*$/',
            'email' => [
                'required',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'phone' => [
                'required',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'image' => 'image|mimes:jpeg,jpg,png,|max:5000|min:50'
        ]);

        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->updated_at = Carbon::now();

        if ($request->file('image')) {
            if ($user->profile_photo_path != NULL)
                unlink(public_path($user->profile_photo_path));

            $image = $request->file('image');
            $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save(public_path('/uploads/profile-photos/') . $img_name);
            $img_loc = 'uploads/profile-photos/' . $img_name;
            $user->profile_photo_path = $img_loc;
        }

        $user->save();


        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.profile')->with($notification);
    }

    public function changePassword()
    {
        $user = User::find(Auth::user()->id);
        return view('user.change_password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $validatedInputs = $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|alpha_num|min:8',
            'new_password_confirm' => 'required|same:new_password'

        ], [
            'current_password.min' => 'The current password is incorrect',
            'new_password.min' => 'Password must contain 8 characters',
            'new_password_confirm.same' => 'The passwords do not match'
        ]);

        $hashedPass = User::find(Auth::user()->id)->password;

        if (Hash::check($request->current_password, $hashedPass)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->new_password);
            $user->save();
            Session::flush();
            return redirect()->route('user.logout');
        } else {
            $notification = array(
                'message' => 'Current Password is Wrong. Try again Later',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);;
        }
    }
}
