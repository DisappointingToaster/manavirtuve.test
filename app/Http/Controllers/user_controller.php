<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class user_controller extends Controller
{
    //Return user view
    public function register(){
        return view('users.register');
    }
    //New user creation
    public function createUser(Request $request){
        //Veikta lauku validacija un custom error pazinojumi
        $formFields=$request->validate([
            'username'=>'required|min:3|unique:users,name',
            'email'=>'required|email|unique:users,email|max:255',
            'password'=>'required|confirmed|min:6'
        ]);
        //password gets encrypted
        $formFields['password']=bcrypt($formFields['password']);
        $user=User::create([
        'name'=>$formFields['username'],
        'email'=>$formFields['email'],
        'password'=>$formFields['password']
        ]);
        //user gets authenticated
        auth()->login($user);
        return redirect('/');
    }
    //user logs out of the system
    public function logoutUser(Request $request){
        auth()->logout();
        //session data gets deleted
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    //returns login view
    public function login(){
        return view('users.login');
    }
    //user logging in to the system
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
    //returns user information update view
    public function update(){
        return view('users.update');
    }
    //user information update
    public function updateUser(User $user,Request $request){
        //checks if usernam has changed
        if($user->name!=$request->username){
            //checks if email has changed
            if($user->email!=$request->email){
                
                $formFields=$request->validate([
                    'username'=>'min:3|unique:users,name',
                    'password'=>'required|confirmed|min:6',
                    'email'=>'email|unique:users,email|max:255'
                ]);
                //updates username and password
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
            //updates username
            if(Hash::check($formFields['password'],$user->password)){
                $user->update([
                    'name'=>$formFields['username'],
                    'email'=>$formFields['email'],
                ]);
                return redirect('/profile/userInfo');
            }
            return back()->withErrors(['password'=>'Invalid Password']);
        }
        //if email has changed, only updates email
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
