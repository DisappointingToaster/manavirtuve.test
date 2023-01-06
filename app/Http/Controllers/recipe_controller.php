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
        $request->validate([
            'recipe_name'=>'required|max:255',
            'tags'=>'nullable',
            'recipe_description'=>'required|max:4000',
            'recipe_image'=>'nullable|mimes:jpg,png,jpeg|max:5048'
        ]);
        if($request->recipe_image!=null){
        $recipeImageName = time().'-'.$request->recipe_name.'.'. 
        $request->recipe_image->extension();
        $request->recipe_image->move(public_path('images/recipes'), $recipeImageName);
        $recipe= Recipes::create([
            'name'=>$request->input('recipe_name'),
            'tags'=>$request->input('tags'),
            'description'=>$request->input('recipe_description'),
            'image_path'=>$recipeImageName
        ]);
    }else{
        $recipe= Recipes::create([
            'name'=>$request->input('recipe_name'),
            'tags'=>$request->input('tags'),
            'description'=>$request->input('recipe_description'),
        ]);
    }
        
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
    public function editRecipe(Recipes $recipe){
        return view('recipes.editRecipe',[
            'recipe'=>$recipe
        ]);
    }
    public function updateRecipe(Recipes $recipe, Request $request){
        $request->validate([
            'recipe_name'=>'required|max:255',
            'tags'=>'nullable',
            'recipe_description'=>'required|max:4000',
            'recipe_image'=>'nullable|mimes:jpg,png,jpeg|max:5048'
        ]);
        if($request->recipe_image!=null){
        $recipeImageName = time().'-'.$request->recipe_name.'.'. 
        $request->recipe_image->extension();
        $request->recipe_image->move(public_path('images/recipes'), $recipeImageName);
        $recipe->update([
            'name'=>$request->input('recipe_name'),
            'tags'=>$request->input('tags'),
            'description'=>$request->input('recipe_description'),
            'image_path'=>$recipeImageName
        ]);
        }else{
            $recipe->update([
                'name'=>$request->input('recipe_name'),
                'tags'=>$request->input('tags'),
                'description'=>$request->input('recipe_description'),
            ]);
        };
        
        return back();
    }
}
