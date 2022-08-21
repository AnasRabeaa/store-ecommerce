<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;


class LoginController extends Controller
{
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


    public function postLogin(AdminLoginRequest $request) {

        // validation
        // check , store , update
        $remember_me = $request->has('remember_me') ? true : false;
        if (auth()->guard ('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {

            return redirect() -> route('admin.dashboard');
        }

        return redirect()->back()->with(['error' => 'خطا في البيانات']);
    }
}
