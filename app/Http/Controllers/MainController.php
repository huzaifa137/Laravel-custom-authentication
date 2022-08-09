<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class MainController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function authsave(Request $request)
    {
        $request->validate([
            'fname'=>'required',
            'email'=>'required|unique:Admins',
            'phonenumber'=>'required|min:10|max:10',
            'password'=>'required|min:5|max:12'
        ]);

        $Admin = new Admin();
        $Admin->name = $request->input('fname');
        $Admin->email = $request->input('email');
        $Admin->phonenumber = $request->input('phonenumber');
        $Admin->password = Hash::make($request->input('password'));
        $save = $Admin->save();

        if($save)
        {
            return back()->with('success','Account created Successfully');
        }
        else
        {
            return back()->with('fail','Failed to create account');
        }
    }

    public function authcheck(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required|min:5|max:12'
        ]);

        $userInfo = Admin::where('email','=',$request->email)->first();

        if(!$userInfo)
        {
            return back()->with('fail','Email not registered');
        }

        else if($userInfo = Admin::all()
        ->where('email','=',$request->email)
        ->where('status','=','invalid')
        ->first())
        {
            return back()->with('fail','Account not activated');    
        }

        else
        {            
           if(Hash::check($request->password,$userInfo->password))
           {
                $request->session()->put('LoggedUser',$userInfo->id);
                return redirect('Admin.dashboard');
           }
           else
        {
           return back()->with('fail','incorrect password'); 
        }
        }
    }

    public function logout()
    {
        if(session()->has('LoggedUser'))
        {
            session()->pull('LoggedUser');
            return redirect('auth.login');
        }
    }

    public function dashboard()
    {
        $data=['LoggedUser'=>Admin::where('id','=',session('LoggedUser'))->first()];
        return view('Admin.dashboard',$data);
    }
}
