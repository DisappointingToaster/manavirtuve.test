@extends('layout')


@section('content')

<div>
    <div class='promoted_recipes'>
        @forelse ($promotedRecipes as $promotedRecipe)
        <div class='promoted_card'>
            <div class='card_back'>
                <img src="{{$promotedRecipe->image_path ? asset('images/recipes/'.$promotedRecipe->image_path) : asset('images/missing.jpg') }} ">
                
            </div>
            <div class='card_front'>
                <a href="/recipes/{{$promotedRecipe->id}}">{{$promotedRecipe->name}}</a>
                <p>{{$promotedRecipe->description}}</p>
            </div>
        </div> 
        @empty
            <h2>No promoted recipes at the moment</h2>
        @endforelse
        
    </div>
    
    <div class='recipe_listings'>
            <div class='popular_recipes'>
                <h2>Popular recipes</h2>
                @foreach ($popularRecipes as $popularRecipe)
                <div class='listing_card'>
                    <img src="{{$popularRecipe->image_path ? asset('images/recipes/'.$popularRecipe->image_path) : asset('images/missing.jpg') }} ">
                    <a href="/recipes/{{$popularRecipe->id}}">{{$popularRecipe->name}}</a>
                    <p>{{$popularRecipe->description}}</p>
                </div>
                @endforeach
        </div>
        <div class='new_recipes'>
            <h2>New Recipes</h2>
            @foreach ($latestRecipes as $latestRecipe)
                <div class='listing_card'>
                    <img src="{{$latestRecipe->image_path ? asset('images/recipes/'.$latestRecipe->image_path) : asset('images/missing.jpg') }} ">
                    <a href="/recipes/{{$latestRecipe->id}}">{{$latestRecipe->name}}</a>
                    <p>{{$latestRecipe->description}}</p>
                </div>
                @endforeach
        </div>
    </div>
    <div class="recently_viewed">
        @if(!$recentlyViewed==null)
            @if(count($recentlyViewed)!=0)
            <h3>Recently viewed recipes</h3>
            <div class='recently_viewed_container'>
                @foreach ($recentlyViewed as $recentRecipe)
                <div class='recently_viewed_frame'> 
                    <img src="{{$recentRecipe->image_path ? asset('images/recipes/'.$recentRecipe->image_path) : asset('images/missing.jpg') }} ">
                    <a href="/recipes/{{$recentRecipe->id}}">{{$recentRecipe->name}}</a>
                </div>
                @endforeach
            </div>
            @endif
        @endif
    </div>
</div>
@endsection