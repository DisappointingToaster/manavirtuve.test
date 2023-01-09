<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class comment_controller extends Controller
{
    public function postComment(Recipes $recipe, Request $request){
        
        if(Auth::check()){
            $formFields=$request->validate([
                'comment_body'=>'required'
            ]);
            $comment=Comments::create([
                'description'=>$request['comment_body'],
                'user_id'=>auth()->user()->id,
                'recipe_id'=>$recipe->id
            ]);
            return redirect('/recipes/'.$recipe->id);
        }else
        {
            redirect()->back()->with('message','Login to comment');
        }
        
    }
}
