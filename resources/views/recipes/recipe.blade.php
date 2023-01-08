@extends('layout')


@section('content')

<div class='single_recipe_display_container'>
        <a href="/recipes/{{$recipe->id}}/edit">Edit recipe</a>
        
        <button>Favourite</button>
        <form method="POST" action ="/recipes/{{$recipe->id}}">
        @csrf
        @method('DELETE')
        <button class="delete_button">Delete recipe</button>
        </form>
        <form method="POST" action ="/recipes/{{$recipe->id}}/promote">
        @csrf
        @method('PUT')
                @if($recipe->promoted!=true)
                        <button class="promote_button" name="promote_button" value="true">Promote recipe</button>
                @else
                        <button class="promote_button" name="promote_button" value="false">Unpromote recipe</button>
                @endif
        </form>

        <div class='single_recipe'>
                <img src="{{URL('images/missing.jpg')}}">
                <h1>{{$recipe->name}}</h1>
                <span>{{$recipe->tags}}</span>
                <p>{{$recipe->description}}</p>
        </div>    
</div>
@endsection