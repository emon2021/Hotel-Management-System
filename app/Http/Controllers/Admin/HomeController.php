<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
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

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($credential))
        {
            $request->user()->sendEmailVerificationNotification();
            return redirect()->route('verification.notice');
        }


        
    }

    //  email verification notice send
    public function verify_notice()
    {
        if(Auth::user()->email_verified_at)
        {
            return redirect(route('admin.home'));
        }
        return view('admin.auth.verify-email');
    }
    // if email verified == true : then: go to home page
    public function verify(EmailVerificationRequest $request) 
    {
        $request->fulfill();
     
        return redirect(route('admin.home'));
    }
    //  resend email verification link
    public function resend (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    }





}
