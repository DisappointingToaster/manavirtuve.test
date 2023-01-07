@extends('layout')


@section('content')

<div>
    <div class='promoted_recipes'>
        <div class='promoted_card'>
            <div class='card_back'>
                <img src="{{URL('images/chicken.jpg')}}">
                
            </div>
            <div class='card_front'>
                <h2>Promoted recipe 1</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, vitae incidunt similique ipsa necessitatibus repudiandae placeat alias possimus libero qui rerum unde mollitia facilis. Aperiam doloribus fugit tempore laudantium facilis!</p>
            </div>
        </div>
        <div class='promoted_card'>
            <div class='card_back'>
                
                <img src="{{URL('images/egg.jpg')}}">
            </div>
            <div class='card_front'>
                <h2>Promoted recipe 2</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, vitae incidunt similique ipsa necessitatibus repudiandae placeat alias possimus libero qui rerum unde mollitia facilis. Aperiam doloribus fugit tempore laudantium facilis!</p>
            </div>
        </div>
        <div class='promoted_card'>
            <div class='card_back'>
                
                <img src="{{URL('images/toast.jpg')}}">
            </div>
            <div class='card_front'>
                <h2>Promoted recipe 3</h2>
                <p>Test text 12355677</p>
            </div>
        </div>
    </div>

    <div class='recently_viewed_container'>
        @for($i=0;$i<10;$i++)
        <div class='recently_viewed_frame'> 
            <img src="{{URL('images/missing.jpg')}}">
            <h5>Recently viewed recipe</h5>
        </div>
        @endfor
    </div>
    
    <div class='recipe_listings'>
            <div class='popular_recipes'>
                <h2>Popular recipes</h2>
                @foreach ($popularRecipes as $popularRecipe)
                <div class='listing_card'>
                    <img src="{{$popularRecipe->image_path ? asset('images/recipes/'.$popularRecipe->image_path) : asset('images/missing.jpg') }} ">
                    <h3>{{$popularRecipe->name}}</h5>
                    <p>{{$popularRecipe->description}}</p>
                </div>
                @endforeach
        </div>
        <div class='new_recipes'>
            <h2>New Recipes</h2>
            @foreach ($latestRecipes as $latestRecipe)
                <div class='listing_card'>
                    <img src="{{$latestRecipe->image_path ? asset('images/recipes/'.$latestRecipe->image_path) : asset('images/missing.jpg') }} ">
                    <h3>{{$latestRecipe->name}}</h5>
                    <p>{{$latestRecipe->description}}</p>
                </div>
                @endforeach
        </div>
    </div>
</div>
@endsection