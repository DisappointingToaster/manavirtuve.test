<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use Illuminate\Http\Request;

class main_route_handler extends Controller
{
    public function index(){
        $latestRecipes=Recipes::latest()->limit(5)->get();
        $popularRecipes=Recipes::all()->sortBy('favourites')->take(5);
        return view('homepage',[
            'latestRecipes'=>$latestRecipes,
            'popularRecipes'=>$popularRecipes
        ]);
    }
    public function kitchen(){
        return view('kitchen.kitchen');
        
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
    public function addRecipe(){
        return view('recipes.addRecipe');
    }
}
