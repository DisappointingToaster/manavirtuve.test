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
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, vitae incidunt similique ipsa necessitatibus repudiandae placeat alias possimus libero qui rerum unde mollitia facilis. Aperiam doloribus fugit tempore laudantium facilis!</p>
            </div>
        </div>
    </div>

    <div class='recently_viewed'>
        <ul>
            <li>
                Recently viewed recipe 1
            </li>
            <li>
                Recently viewed recipe 2
            </li>
            <li>
                Recently viewed recipe 3
            </li>
        </ul>
    </div>
    
    <div name='recipe_listings'>
        <div name='popular_recipes'>
            <ul>
                <li>
                    Popular recipe 1
                </li>
                <li>
                    Popular recipe 2
                </li>
                <li>
                    Popular recipe 3
                </li>
            </ul>
        </div>
        <div name='new_recipes'>
            <ul>
                <li>
                    New recipe 1
                </li>
                <li>
                    New recipe 2
                </li>
                <li>
                    New recipe 3
                </li>

            </ul>
        </div>
    </div>
</div>
@endsection