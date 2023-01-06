@extends('layout')


@section('content')

<div class='single_recipe_display_container'>
        <button>Edit recipe</button>
        <button>Favourite</button>
        <div class='single_recipe'>
                <img src="{{URL('images/missing.jpg')}}">
                <h1>{{$recipe->name}}</h1>
                <span>{{$recipe->tags}}</span>
                <p>{{$recipe->description}}</p>
        </div>    
</div>
@endsection