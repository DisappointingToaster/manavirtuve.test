<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use App\Models\Ingredients;
use Illuminate\Http\Request;

class recipe_controller extends Controller
{
    public function recipes(){
        $ingredients=Ingredients::all()->sortBy('ingredient_type');
        $recipes=Recipes::all();
        return view('recipes',['ingredients'=>$ingredients]);
        
    }
}
