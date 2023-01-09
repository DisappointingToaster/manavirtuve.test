<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use Illuminate\Http\Request;

class main_route_handler extends Controller
{
    public function index(){
        $latestRecipes=Recipes::latest()->limit(5)->get();
        $popularRecipes=Recipes::all()->sortBy('favourites')->take(5);
        $promotedRecipes=Recipes::all()->where('promoted','=',true)->shuffle()->take(3);
        $recentlyViewed=session()->get('recipe.recently_viewed');
        //session()->flush();
        if(!$recentlyViewed==null){
            array_slice($recentlyViewed,-10,10);
            $recentRecipes=Recipes::whereIn('id',$recentlyViewed)->latest()->take(10)->get();
        }else{
            $recentRecipes=null;
        }
        return view('homepage',[
            'latestRecipes'=>$latestRecipes,
            'popularRecipes'=>$popularRecipes,
            'promotedRecipes'=>$promotedRecipes,
            'recentlyViewed'=>$recentRecipes
        ]);
    }
    
    public function profile(){
        return view('users.userInfo');
    }
    public function profileSecurity(){
        return view('users.userSecurity');
    }
    
    public function fridge(){
        return view('fridge');
    }
    
    
}
