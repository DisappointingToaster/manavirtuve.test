<?php

namespace App\Http\Controllers;

use App\Models\Kitchen;
use App\Models\Recipes;
use App\Models\Ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Ingredient_Categories;

class recipe_controller extends Controller
{
    //returns view of all recipes for seaching
    public function recipes(Request $request){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        $recipes=Recipes::latest()->where('hidden','=',false)->filter
            (request(['category','searchName']))->get();
        return view('recipes.recipes',[
            'recipes'=>$recipes,
        ])->with('ingredient_categories',$ingredient_categories);
        
    }
    //shows single recipe
    public function showSingleRecipe(Recipes $recipe){
        //adding recently_viewed to session
        if(!session()->has('recipe.recently_viewed',$recipe->id)){
            session()->push('recipe.recently_viewed',$recipe->id);
        }
        if(Auth::user()){
            $favouritedRecipes=Kitchen::all()->where('user_id','=',auth()->user()->id)->where('recipe_id','=',$recipe->id);
        }else{
            $favouritedRecipes=null;
        }
        return view('recipes.recipe',[
            'recipe'=>$recipe,
            'favourites'=>$favouritedRecipes
        ]);
    }
    //recipe creation
    public function createRecipe(Request $request){
        //ingredient conversion to string 
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
    //admin view to modify filters
    public function modifyFilters(){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        return view('moderation.modifyFilters')->with('ingredient_categories',$ingredient_categories);
    }
    //admin can add category
    public function createCategory(Request $request){
        //check if category already exists
        if(Ingredient_Categories::where('category_name','like',$request->category_name)->exists()){
            return redirect('/moderation/editFilters')->with('message','Category already exists');
        };   
        $category=Ingredient_Categories::create([
        'category_name'=>$request->input('category_name')
        ]);

        return redirect('/moderation/editFilters')->with('message','Category created');
    }

    //admin can add ingredients
    public function createIngredient(Request $request){
        //check if ingredient already exists
        if(Ingredients::where('ingredient_name','like',$request->ingredient_name)->exists()){
            return redirect('/moderation/editFilters')->with('message','Ingredient already exists');
        }; 
        $ingredient=Ingredients::create([
        'ingredient_name'=>$request->input('ingredient_name'),
        'category_id'=>$request->input('categories')
        ]);
        return redirect('/moderation/editFilters')->with('message','Ingredient created');;
    }
    //return view of recipe edit
    public function editRecipe(Recipes $recipe){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        
        return view('recipes.editRecipe',[
            'recipe'=>$recipe
        ])->with('ingredient_categories',$ingredient_categories);
    }
    //post request to update recipe. similar to creation
    public function updateRecipe(Recipes $recipe, Request $request){
        //checking if recipe owner is current user
        if($recipe->user_id!=auth()->user()->id){
            return redirect('/kitchen');
        }
        //creating a string from array
        $input=$request->all();
        if(!empty($input['tags'])){
        sort($input['tags']);
        $tags=implode(', ',$input['tags']);
        }else{
            $tags=null;
        };
        //validating inputs
        $request->validate([
            'recipe_name'=>'required|max:255',
            'tags'=>'nullable',
            'recipe_description'=>'required|max:4000',
            'recipe_image'=>'nullable|mimes:jpg,png,jpeg|max:5048'
        ]);
        //updating recipe
        if($request->recipe_image!=null){
            $recipeImageName = time().'-'.$request->recipe_name.'.'. 
            $request->recipe_image->extension();
            $request->recipe_image->move(public_path('images/recipes'), $recipeImageName);
            $recipe->update([
                'name'=>$request->input('recipe_name'),
                'tags'=>$tags,
                'description'=>$request->input('recipe_description'),
                'image_path'=>$recipeImageName
        ]);
        }else{
            $recipe->update([
                'name'=>$request->input('recipe_name'),
                'tags'=>$tags,
                'description'=>$request->input('recipe_description'),
            ]);
        };
        
        return redirect('/recipes/'.$recipe->id)->with('message','Recipe updated');
    }
    //delete recipe
    public function deleteRecipe(Recipes $recipe){  
        //checking recipe ownership
        if($recipe->user_id!=auth()->user()->id){
            return redirect('/kitchen');
        }
        //removing recipe from session
        session()->forget('recipe.recently_viewed',[$recipe->id]);
        //deleting recipe
        $imagePath="images/recipes/" . $recipe->image_path;
        if(File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $recipe->delete();
        return redirect('/recipes')->with('message','Recipe deleted');
    }
    //ingredient deletion
    public function deleteIngredient(Ingredients $ingredient){
        $ingredient->delete();
        return redirect()->back()->with('message','Ingredient deleted');
    }
    //category deletion
    public function deleteCategory(Ingredient_Categories $category){
        $category->delete();
        return redirect()->back()->with('message','Category deleted');
    }
    //returns kitchen view
    public function kitchen(){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        $recipes=Recipes::all()->where('user_id','=',auth()->user()->id);
        $favouritedRecipes=Kitchen::all()->where('user_id','=',auth()->user()->id);
        return view('kitchen.kitchen',[
            'recipes'=>$recipes,
        ])->with('ingredient_categories',$ingredient_categories)->with('fav_recipes',$favouritedRecipes);
        
    }
    //user adds recipe
    public function addRecipe(){
        $ingredient_categories=Ingredient_Categories::all()->sortBy('category_name');
        return view('recipes.addRecipe')->with('ingredient_categories',$ingredient_categories);
    }
    //admin/mod can promote recipe
    public function promoteRecipe(Request $request, Recipes $recipe){
        //sets recipe to unpromoted
        if($request->promote_button==="false"){
            $recipe->update([
                'promoted'=>false
            ]);
        }
        //checks if recipe has ingredient tags. otherwise promotes
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
    //owner can publish recipe
    public function publishRecipe(Request $request, Recipes $recipe){
        //check if owner made the request
        if($recipe->user_id!=auth()->user()->id){
            return redirect('/kitchen');
        }
        if($recipe->forcedHidden==true){
            return redirect('/kitchen')->with('message', 'Recipe can not be published');
        }
        //if recipe is published, set it to false
        if($request->publish_button==="false"){
            $recipe->update([
                'hidden'=>false
            ]);
            return back()->with('message','Recipe Published.');
        }
        //if recipe is published, set it to true
        if($request->publish_button==="true"){
                $recipe->update([
                    'hidden'=>true
                ]);
                return back()->with('message','Recipe hidden.');
            }
    }
    //moderator forcefull hiding recipe
    public function forceHide(Recipes $recipe, Request $request){
        if($request->forceHide_button==="false"){
            $recipe->update([
                'forcedHidden'=>false,
                
            ]);
            return back()->with('message','Recipe unhidden.');
        }
        if($request->forceHide_button==="true"){
                $recipe->update([
                    'forcedHidden'=>true,
                    'hidden'=>true
                ]);
                return back()->with('message','Recipe forced hidden.');
            }
    }
    //user saving recipes to their kitchen
    public function favouriteRecipe(Recipes $recipe){
        //checks if recipe is already favourited
        if(Kitchen::where('recipe_id','=',$recipe->id)->where('user_id','=',auth()->user()->id)->exists()){
            return back()->with('message','Can\'t favourite recipe');
        }
        //checks if user is authenticated, then saves recipe
        if(Auth::check()){
            Kitchen::create([
                'user_id'=>auth()->user()->id,
                'recipe_id'=>$recipe->id
            ]);
        return back()->with('message','Recipe favourited');
    }else{
        return back()->with('message','Can\'t favourite recipe');
    }; 
    }
    //user unvaourites their recipe
    public function deleteFavourite(Recipes $recipe){
        //finds all favourited entries of the recipe
        $kitchen=Kitchen::all()->where('recipe_id','=',$recipe->id)->where('user_id','=',auth()->user()->id);
        //each of the entries is deleted. This is assuming duplicate ever was made
        $kitchen->each->delete();
        return redirect()->back()->with('message','Recipe unfavourited');
    }

}
