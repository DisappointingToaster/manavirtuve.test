<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class user_controller extends Controller
{
    //Tiek argriezts registracijas skats
    public function register(){
        return view('users.register');
    }
    //Jauna lietotaja izveide
    public function createUser(Request $request){
        //Veikta lauku validacija un custom error pazinojumi
        $formFields=$request->validate([
            'username'=>'required|min:3|unique:users,name',
            'email'=>'required|email|unique:users,email|max:255',
            'password'=>'required|confirmed|min:6'
        ],[
            'username.required'=>'Lietotājvārds ir obligāts lauks',
            'username.min'=>'Lietojvārdam jasatur vismaz 3 simbolus',
            'username.unique'=>'Lietotājvārds ir aizņemts',
            'email.required'=>'E-pasts ir obligāts lauks',
            'email.email'=>'Nederīgs e-pasts',
            'email.unique'=>'E-pasts ir aizņemts',
            'email.max'=>'E-pasts pārsniedz 255 simbolus'
        ]);
        //parole tiek sifreta
        $formFields['password']=bcrypt($formFields['password']);
        $user=User::create([
        'name'=>$formFields['username'],
        'email'=>$formFields['email'],
        'password'=>$formFields['password']
        ]);
        //pec lietotaja izveides tiek autorizets lietotajs
        auth()->login($user);
        return redirect('/');
    }
    //lietotajs atsakas no sistemas
    public function logoutUser(Request $request){
        auth()->logout();
        //sesijas dati tiek aizmirsti un jauns zetons izveidots
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    //atgriez login skatu
    public function login(){
        return view('users.login');
    }
    //lietotaja pieteiksanas sistema
    public function loginUser(Request $request){
        $formFields=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message',"Successfully logged in");
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
