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
        return view('recipes.recipes',[
            'ingredients'=>$ingredients,
            'recipes'=>$recipes,
        ]);
        
    }
    public function showSingleRecipe(Recipes $recipe){
        return view('recipes.recipe',[
            'recipe'=>$recipe,
        ]);
    }
    public function createRecipe(Request $request){
        $recipe= Recipes::create([
            'name'=>$request->input('recipe_name'),
            'tags'=>$request->input('tags'),
            'description'=>$request->input('recipe_description')
        ]);
        return redirect('/kitchen');
    }
}
