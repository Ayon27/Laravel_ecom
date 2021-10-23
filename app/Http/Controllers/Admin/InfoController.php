<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactNumber;
use App\Models\EmailAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,admin');
        $this->middleware('prevent-back-button');
        $this->middleware('XssSanitizer');
    }

    public function phoneInfo()
    {
        try {
            $phone = ContactNumber::get();
            return view('admin.contact.phone_index', compact('phone'));
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'An error occurred',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function addPhone(Request $request)
    {
        $request->validate([
            'contact_number' => 'max:50|required|unique:contact_numbers,phone'
        ], [
            'contact_number.unique' => 'This number already exists in the system'
        ]);

        try {
            $phone = new ContactNumber();
            $phone->phone = $request->contact_number;
            $phone->created_at = Carbon::now();

            $phone->save();

            $notification = array(
                'message' => 'Successfully added',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed to add phone number',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function deletePhone($id)
    {
        try {
            ContactNumber::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Successfully deleted',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed to delete phone number',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function emailInfo()
    {
        try {
            $email = EmailAddress::get();
            return view('admin.contact.email_index', compact('email'));
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'An error occurred',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function addEmail(Request $request)
    {
        $request->validate(
            [
                'email_address' => 'required|email|unique:email_addresses,email'
            ],
            ['email_address.unique' => 'This email already exists in the system']
        );

        try {
            $email = new EmailAddress();
            $email->email = $request->email_address;
            $email->created_at = Carbon::now();

            $email->save();

            $notification = array(
                'message' => 'Successfully added',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed to add email',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }
    public function deleteEmail($id)
    {
        try {
            EmailAddress::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Successfully deleted',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            $notification = array(
                'message' => 'Failed to delete email address',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }
}
