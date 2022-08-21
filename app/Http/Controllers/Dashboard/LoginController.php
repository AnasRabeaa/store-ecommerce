<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;



class LoginController extends Controller
{
    //View Admin Login Form Function
    public function login(){
        return view('dashboard.auth.login');
    }

    // public function save(){

    //     $admin = new App\Models\Admin();
    //     $admin -> name ="Anas Rabea";
    //     $admin -> email ="anas@gmail.com";
    //     $admin -> password = bcrypt("Anas Rabea");
    //     $admin -> save();

    // }


    //Checks If Admin In Exists In Database Function
    public function postLogin(AdminLoginRequest $request) {

        // validation
        // check , store , update
        $remember_me = $request->has('remember_me') ? true : false;
        if (auth()->guard ('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {

            return redirect() -> route('admin.dashboard');
        }

        return redirect()->back()->with(['error' => 'خطا في البيانات']);
    }

    //Admin Logout Function
    public function logoutAdmin() {
        //using logout trait
        $adminLogout = auth()->guard('admin');
        $adminLogout->logout();

        return redirect()->route('admin.login');
    }
}
