<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //  index
    public function index()
    {
        return view('home');
    }

    //  register.create
    public function register_create()
    {
        return view('admin.auth.register');
    }
    //  register
    public function register(RegisterRequest $request)
    {
        $request->validated();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();

        $notification = array(
            'message' => 'User created successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
