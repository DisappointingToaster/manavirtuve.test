<?php

namespace App\Http\Controllers;

use App\Models\Ingredient_Categories;
use App\Models\Recipes;
use App\Models\Ingredients;
use Illuminate\Http\Request;

class recipe_controller extends Controller
{
    public function recipes(){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        $recipes=Recipes::all();
        return view('recipes.recipes',[
            'recipes'=>$recipes,
        ])->with('ingredient_categories',$ingredient_categories);
        
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
    public function modifyFilters(){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        return view('moderation.modifyFilters')->with('ingredient_categories',$ingredient_categories);
    }
    public function createCategory(Request $request){
        $category=Ingredient_Categories::create([
        'category_name'=>$request->input('category_name')
        ]);
        return redirect('/moderation/editFilters');
    }
    public function createIngredient(Request $request){
        $ingredient=Ingredients::create([
        'ingredient_name'=>$request->input('ingredient_name'),
        'category_id'=>$request->input('categories')
        ]);
        return redirect('/moderation/editFilters');
    }

}
