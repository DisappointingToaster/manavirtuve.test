@extends('layout')


@section('content')

<div>
    <div class="new_recipe_button">    
        <a href="/kitchen/new" class="button">Add new recipe</a>
    </div>
    <div class='kitchen_recipe_container'>
        <h1>My recipes</h1>
        <div class='display_box_container'>
            
            @forelse($recipes as $recipe)
            
                <div class='diplay_box'>
                
                    <img src="{{$recipe->image_path ? asset('images/recipes/'.$recipe->image_path) : asset('images/missing.jpg') }} ">
                    <a href="/recipes/{{$recipe->id}}">{{$recipe->name}}</a>
                    <span>{{$recipe->tags}}</span>
                    <span>{{$recipe->description}}</span>
                </div>
            @empty
            <p>Sorry, no recipes to display</p>
            @endforelse
        </div>
    <div>    
        <div class='kitchen_recipe_container'>
            <h1>My saved recipes</h1>
            <div class='display_box_container'>
                
                @forelse($fav_recipes as $fvR)
                
                    <div class='diplay_box'>
                        <img src="{{$fvR->recipes->image_path ? asset('images/recipes/'.$fvR->recipes->image_path) : asset('images/missing.jpg') }} ">
                        
                        <a href="/recipes/{{$fvR->recipes->id}}">{{$fvR->recipes->name}}</a>
                        <span>{{$fvR->recipes->tags}}</span>
                        <span>{{$fvR->recipes->description}}</span>
                    </div>
                @empty
                <p>Sorry, no recipes to display</p>
                @endforelse
            </div>
        <div>    
</div>
@endsection