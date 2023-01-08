<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class user_controller extends Controller
{
    //
    public function register(){
        return view('users.register');
    }

    public function createUser(Request $request){
        $formFields=$request->validate([
            'username'=>'required|min:3|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed|min:6'
        ]);
        $formFields['password']=bcrypt($formFields['password']);
        
        $user=User::create([
        'name'=>$formFields['username'],
        'email'=>$formFields['email'],
        'password'=>$formFields['password']
        ]);
        auth()->login($user);
        return redirect('/');
    }
    public function logoutUser(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function login(){
        return view('users.login');
    }
    public function loginUser(Request $request){
        $formFields=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/');
        }
        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
    }
}
