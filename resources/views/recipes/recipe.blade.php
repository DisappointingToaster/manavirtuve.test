@extends('layout')


@section('content')

<div class='single_recipe_display_container'>
        <a href="/recipes/{{$recipe->id}}/edit">Edit recipe</a>
        
        <button>Favourite</button>
        @if(auth()->user()->role_id>1 || auth()->user()->id==$recipe->user_id)
                <form method="POST" action ="/recipes/{{$recipe->id}}">
                @csrf
                @method('DELETE')
                <button class="delete_button">Delete recipe</button>
        @endif
        </form>
        @if($recipe->forcedHidden!=true)
                @if(auth()->user()->id==$recipe->user_id)
                <form method="POST" action ="/recipes/{{$recipe->id}}/publish">
                @csrf
                @method('PUT')
                        @if($recipe->hidden==true)
                                <button class="publish_button" name="publish_button" value="false">Publish recipe</button>
                        @else
                                <button class="publish_button" name="publish_button" value="true">Unpublish recipe</button>
                        @endif
                </form>
                @endif  
        @endif       
        @if(auth()->user()->role_id>2)
                <form method="POST" action ="/recipes/{{$recipe->id}}/promote">
                @csrf
                @method('PUT')
                        @if($recipe->promoted!=true)
                                <button class="promote_button" name="promote_button" value="true">Promote recipe</button>
                        @else
                                <button class="promote_button" name="promote_button" value="false">Unpromote recipe</button>
                        @endif
                </form>
        @endif
        <div class='single_recipe'>
                <img src="{{URL('images/missing.jpg')}}">
                <h1>{{$recipe->name}}</h1>
                <span>{{$recipe->tags}}</span>
                <p>{{$recipe->description}}</p>
        </div>    
</div>
@endsection