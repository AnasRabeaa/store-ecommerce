<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Hash;
use DB;
use PHPUnit\Exception;

class AdminProfileController extends Controller
{
    //Admin Profile View Function
    public function adminProfile()
    {
        $admin = auth()->guard('admin')->user();
        return view('dashboard.profile.profile', compact('admin'));
    }

    //Updating Admin Profile Professionally
    public function updateAdminProfile(AdminProfileRequest $request)
    {
        //write your functionality here
        $admin = Admin::find(auth()->guard('admin')->user()->id);
        if (Hash::check($request->currentPassword, $admin->password)) {
            if (!$request->has('photo')) {
                $image_name = $admin->photo;
            } else {
                $image_name = $this->storeImage('admins', $request->photo);
            }
            $admin->photo = $image_name;
            if ($request->newPassword != null && $request->confirmNewPassword != null) {
                if ($request->newPassword === $request->confirmNewPassword) {
                    if (!is_numeric($request->newPassword) || !is_numeric($request->confirmNewPassword)) {
                            $admin->update([
                                'name' => $request->name,
                                'email' => $request->email,
                                'password' => bcrypt($request->confirmNewPassword),
                            ]);
                        return redirect()->back()->with(['success' => 'Data Updated Successfully']);
                    } else {
                        return 'New Password Cant Be Only Numbers';
                    }
                } else {
                    return 'New Password Doesnt Match Confirm New Password';
                }
            } else {
                $admin->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
                return redirect()->back()->with(['success' => 'Data Updated Successfully']);
            }

        } else {
            return redirect()->back()->with(['error' => 'Current Password Is Wrong!']);
        }
    }

    //Store Image To Database And Moves It TO Images/Offers File
    public function storeImage($folder, $photo)
    {
        $extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $extension;
        $path = 'assets/images/' . $folder;
        $photo->move($path, $file_name);
        return $file_name;
    }
}
