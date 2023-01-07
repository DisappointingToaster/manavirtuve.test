<?php

namespace App\Http\Controllers;

use App\Models\Ingredient_Categories;
use App\Models\Recipes;
use App\Models\Ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        if(!session()->has('recipe.recently_viewed',$recipe->id)){
            session()->push('recipe.recently_viewed',$recipe->id);
        }
        return view('recipes.recipe',[
            'recipe'=>$recipe,
        ]);
    }
    public function createRecipe(Request $request){
        $input=$request->all();
        if(!empty($input['tags'])){
        sort($input['tags']);
        $tags=implode(', ',$input['tags']);
        }else{
            $tags=null;
        };
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
            'tags'=>$tags,
            'description'=>$request->input('recipe_description'),
            'image_path'=>$recipeImageName
        ]);
    }else{
        $recipe= Recipes::create([
            'name'=>$request->input('recipe_name'),
            'tags'=>$tags,
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
    public function deleteRecipe(Recipes $recipe){
        session()->forget('recipe.recently_viewed',[$recipe->id]);
        $imagePath="images/recipes/" . $recipe->image_path;
        if(File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $recipe->delete();
        return redirect('/recipes');
    }
    public function deleteIngredient(Ingredients $ingredient){
        $ingredient->delete();
        return redirect()->back();
    }
    public function deleteCategory(Ingredient_Categories $category){
        $category->delete();
        return redirect()->back();
    }
    public function kitchen(){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        $recipes=Recipes::all();
        return view('kitchen.kitchen',[
            'recipes'=>$recipes,
        ])->with('ingredient_categories',$ingredient_categories);
        
    }
    public function fridge(){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        return view('fridge')
        ->with('ingredient_categories',$ingredient_categories);
    }
    public function fridgeIngredients(Request $request){
        $input=$request->all();
        sort($input['ingredient']);
        $tags=implode(', ',$input['ingredient']);
        dd($tags);


        return back();
    }
    public function addRecipe(){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        return view('recipes.addRecipe')->with('ingredient_categories',$ingredient_categories);
    }
    public function promoteRecipe(Request $request, Recipes $recipe){
        if($request->promote_button==="true"){
            $recipe->update([
                'promoted'=>true
            ]);
        }
        if($request->promote_button==="false"){
            $recipe->update([
                'promoted'=>false
            ]);
        }
        return back();
    }
}
