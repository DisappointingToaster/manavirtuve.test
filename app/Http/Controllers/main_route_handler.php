<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use Illuminate\Http\Request;

class main_route_handler extends Controller
{
    public function index(){
        $latestRecipes=Recipes::latest()->limit(5)->get();
        $popularRecipes=Recipes::all()->sortBy('favourites')->take(5);
        $promotedRecipes=Recipes::all()->where('promoted','=',true)->take(3);
        $recentlyViewed=session()->get('recipe.recently_viewed');
        
        //session()->flush();
        $recentRecipes=Recipes::whereIn('id',$recentlyViewed)->latest()->take(10)->get();
        return view('homepage',[
            'latestRecipes'=>$latestRecipes,
            'popularRecipes'=>$popularRecipes,
            'promotedRecipes'=>$promotedRecipes,
            'recentlyViewed'=>$recentRecipes
        ]);
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
        return view('moderation.moderation');
    }
    
}
