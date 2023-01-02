<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use Illuminate\Http\Request;

class recipe_controller extends Controller
{
    public function recipes(){
        $ingredients=Ingredients::all();
        return view('recipes',['ingredients'=>$ingredients]);
        
    }
}
