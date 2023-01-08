<?php

namespace App\Http\Controllers;

use App\Models\Ingredient_Categories;
use App\Models\Recipes;
use App\Models\Ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class recipe_controller extends Controller
{
    public function recipes(Request $request){
        
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        $recipes=Recipes::latest()->where('hidden','=',false)->filter
            (request(['search','category']))->get();
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
        $formFields['user_id']=auth()->user()->id;
        if($request->recipe_image!=null){
            $recipeImageName = time().'-'.$request->recipe_name.'.'. 
            $request->recipe_image->extension();
            $request->recipe_image->move(public_path('images/recipes'), $recipeImageName);
            $recipe= Recipes::create([
                'name'=>$request->input('recipe_name'),
                'tags'=>$tags,
                'description'=>$request->input('recipe_description'),
                'image_path'=>$recipeImageName,
                'user_id'=>$formFields['user_id']
            ]);
        }else{
            $recipe= Recipes::create([
                'name'=>$request->input('recipe_name'),
                'tags'=>$tags,
                'description'=>$request->input('recipe_description'),
                'user_id'=>$formFields['user_id']
            ]);
    }
        
        return redirect('/kitchen')->with('message','Recipe created');
    }
    public function modifyFilters(){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        return view('moderation.modifyFilters')->with('ingredient_categories',$ingredient_categories);
    }
    public function createCategory(Request $request){
        $category=Ingredient_Categories::create([
        'category_name'=>$request->input('category_name')
        ]);
        return redirect('/moderation/editFilters')->with('message','Category created');
    }
    public function createIngredient(Request $request){
        $ingredient=Ingredients::create([
        'ingredient_name'=>$request->input('ingredient_name'),
        'category_id'=>$request->input('categories')
        ]);
        return redirect('/moderation/editFilters')->with('message','Ingredient created');;
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
        
        return back()->with('message','Recipe updated');
    }
    public function deleteRecipe(Recipes $recipe){
        session()->forget('recipe.recently_viewed',[$recipe->id]);
        $imagePath="images/recipes/" . $recipe->image_path;
        if(File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $recipe->delete();
        return redirect('/recipes')->with('message','Recipe deleted');
    }
    public function deleteIngredient(Ingredients $ingredient){
        $ingredient->delete();
        return redirect()->back()->with('message','Ingredient deleted');
    }
    public function deleteCategory(Ingredient_Categories $category){
        $category->delete();
        return redirect()->back()->with('message','Category deleted');
    }
    public function kitchen(){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        $recipes=Recipes::all()->where('user_id','=',auth()->user()->id);
        return view('kitchen.kitchen',[
            'recipes'=>$recipes,
        ])->with('ingredient_categories',$ingredient_categories);
        
    }
    
    public function addRecipe(){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        return view('recipes.addRecipe')->with('ingredient_categories',$ingredient_categories);
    }
    public function promoteRecipe(Request $request, Recipes $recipe){
        if($request->promote_button==="false"){
            $recipe->update([
                'promoted'=>false
            ]);
        }
        if($recipe->tags===null){
            return back()->with('message','Recipe without tags can\'t be promoted.');
        } else{
            if($request->promote_button==="true"){
                $recipe->update([
                    'promoted'=>true
                ]);
            }
            return back()->with('message','Recipe set to promoted.');
        }
    }
    public function publishRecipe(Request $request, Recipes $recipe){
        if($request->publish_button==="false"){
            $recipe->update([
                'hidden'=>false
            ]);
            return back()->with('message','Recipe Published.');
        }
        if($request->publish_button==="true"){
                $recipe->update([
                    'hidden'=>true
                ]);
                return back()->with('message','Recipe hidden.');
            }
    }
}
