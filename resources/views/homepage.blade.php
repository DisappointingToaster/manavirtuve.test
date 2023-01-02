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
                @for($i=0;$i<5;$i++)
                <div class='listing_card'>
                    <img src="{{URL('images/missing.jpg')}}">
                    <h3>Popular recipe</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde laborum consequatur tempora id, praesentium reprehenderit quasi quidem maiores nobis nihil earum numquam voluptatibus est perspiciatis laudantium animi quod at neque?</p>
                </div>
            @endfor
        </div>

        <div class='new_recipes'>
            @for($i=0;$i<5;$i++)
                <div class='listing_card'>
                    <img src="{{URL('images/missing.jpg')}}">
                    <h3>New recipe</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde laborum consequatur tempora id, praesentium reprehenderit quasi quidem maiores nobis nihil earum numquam voluptatibus est perspiciatis laudantium animi quod at neque?</p>
                </div>
                @endfor
        </div>
    </div>
</div>
@endsection