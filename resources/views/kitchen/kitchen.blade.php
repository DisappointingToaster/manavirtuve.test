@extends('layout')


@section('content')

<div>
    <div class="new_recipe_button">    
        <a href="/kitchen/new" class="button">Add new recipe</a>
    </div>
        
        <div class='display_box_container'>
            
            @for($i=0;$i<9;$i++)
            
                <div class='diplay_box_2'>
                    <img src="{{URL('images/missing.jpg')}}">
                    <a href='#'>Recipe name</a>
                    <span>Egg, Salt, Bacon</span>
                    <span>Lorem ipsum dolor sit amet, </span>
                </div>
             @endfor
        </div>
        
</div>
@endsection