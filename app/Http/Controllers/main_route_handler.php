<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class main_route_handler extends Controller
{
    public function index(){
        return view('homepage');
    }
    public function kitchen(){
        return view('kitchen');
        
    }
    public function profile(){
        return view('userInfo');
    }
    public function profileSecurity(){
        return view('userSecurity');
    }
    
    public function fridge(){
        return view('fridge');
    }
    public function moderation(){
        return view('moderation');
    }
}
