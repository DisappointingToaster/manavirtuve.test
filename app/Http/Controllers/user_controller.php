<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'email'=>'required|email|unique:users,email|max:255',
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
    public function update(){
        return view('users.update');
    }
    public function updateUser(User $user,Request $request){
        if($user->name!=$request->username){
            if($user->email!=$request->email){
                $formFields=$request->validate([
                    'username'=>'min:3|unique:users,name',
                    'password'=>'required|confirmed|min:6',
                    'email'=>'email|unique:users,email|max:255'
                ]);
                if(Hash::check($formFields['password'],$user->password)){
                    $user->update([
                        'name'=>$formFields['username'],
                        'email'=>$formFields['email'],
                    ]);
                    return redirect('/profile/userInfo');
                }
                return back()->withErrors(['password'=>'Invalid Password']);
            };
            $formFields=$request->validate([
                'username'=>'min:3|unique:users,name',
                'password'=>'required|confirmed|min:6',
            ]);
            $formFields['email']=$user->email;
            if(Hash::check($formFields['password'],$user->password)){
                $user->update([
                    'name'=>$formFields['username'],
                    'email'=>$formFields['email'],
                ]);
                return redirect('/profile/userInfo');
            }
            return back()->withErrors(['password'=>'Invalid Password']);
        }
        if($user->email!=$request->email){
            $formFields=$request->validate([
                'password'=>'required|confirmed|min:6',
                'email'=>'email|unique:users,email|max:255'
            ]);
            $formFields['username']=$user->email;
            if(Hash::check($formFields['password'],$user->password)){
                $user->update([
                    'name'=>$formFields['username'],
                    'email'=>$formFields['email'],
                ]);
                return redirect('/profile/userInfo');
            }
            return back()->withErrors(['password'=>'Invalid Password']);
        }
        return back();

        
    }
}
