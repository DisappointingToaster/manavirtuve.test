@extends('layout')


@section('content')

<div class='single_recipe_display_container'>
        <div class="recipe_buttons">
                @auth

                @if(auth()->user()->id==$recipe->user_id)
                        <a href="/recipes/{{$recipe->id}}/edit">Edit recipe</a>
                @endif
                

                @if($favourites->isEmpty())
                <form action="/recipes/{{$recipe->id}}/favourite" method="POST">
                        @csrf
                        <button type="submit">Favourite</button>
                </form>
                @else
                <form action="/recipes/{{$recipe->id}}/favourite" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Unfavourite</button>
                </form>
                @endif      
                
                @if(auth()->user()->role_id>1 || auth()->user()->id==$recipe->user_id)
                        <form method="POST" action ="/recipes/{{$recipe->id}}">
                        @csrf
                        @method('DELETE')
                        <button class="delete_button" onclick="return confirm('Are you sure you want to delete this recipe?')">Delete recipe</button>
                @endif
                </form>
                @if($recipe->forcedHidden!=true&&auth()->user()->can_post!=false)
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
                @if(auth()->user()->role_id>2&&$recipe->hidden==false)
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
                @if(auth()->user()->role_id>1)
                        <form method="POST" action ="/recipes/{{$recipe->id}}/forceHide">
                        @csrf
                        @method('PUT')
                                @if($recipe->forcedHidden!=true)
                                        <button class="forceHide_button" name="forceHide_button" value="true">Force hide recipe</button>
                                @else
                                        <button class="forceHide_button" name="forceHide_button" value="false">Force unhide recipe</button>
                                @endif
                        </form>
                @endif
                @endauth
        </div>
        <div class='single_recipe'>
                <h2>{{$recipe->name}}</h2>
                <img src="{{$recipe->image_path ? asset('images/recipes/'.$recipe->image_path) : asset('images/missing.jpg') }} ">
                <div >
                        <p class="recipe_tags" style="float:left">Ingredients:&ensp;</p>
                        <p class="recipe_tags" >{{$recipe->tags}}</p>
                </div>
                <p>{!!nl2br($recipe->description)!!}</p>
                @guest
                <p class="author">Made by:<b>{{$recipe->user->name}}</b></p>
                @endguest
                @auth
                        @if(auth()->user()->role_id>1 )
                        <p>Made by:<a href="/users/{{$recipe->user->id}}"> {{$recipe->user->name}}</a></p>
                        @else
                        <p class="author">Made by:<b>{{$recipe->user->name}}</b></p>
                        @endif
                @endauth
                <a href="/report/{{$recipe->user->id}}">Report user</a>
        </div>    
        <div class="comment_area">
                @auth
                        
                
                @if(auth()->user()->can_comment!=false)
                <div class="comment_form">
                        <h5>Leave a comment</h5>
                        <form action="/recipes/{{$recipe->id}}/comment" method="POST">
                                @csrf
                                @error('comment_body')
                                                <p class="comment_error">{{$message}}</p>
                                        @enderror
                                <div class="inner_comment_form">
                                        
                                        <textarea name="comment_body" rows="10" cols="1" required></textarea>
                                        <button type="submit">Submit</button>
                                </div>
                        </form>
                </div>
                @endif
                @endauth
                <div class="comment_box"> 
                        @forelse ($recipe->comments as $comment)
                        <div class="comment_entry">
                                <div class="inner_comment">
                                        @auth
                                                @if(auth()->user()->role_id>1)
                                                <a href="/users/{{$comment->users->id}}">{{$comment->users->name}}</a>
                                                @else
                                                <h3>{{$comment->users->name}}</h3>
                                                @endif
                                        @endauth
                                        @guest
                                                <h3>{{$comment->users->name}}</h3> 
                                        @endguest

                                        <span>{{$comment->created_at}}</span>

                                        <a href="/report/{{$comment->users->id}}">Report user</a>
                                        @auth
                                                @if($comment->users->id==auth()->user()->id || auth()->user()->role_id>1 )
                                                <form action="/comment/{{$comment->id}}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                                </form>
                                                @endif
                                        @endauth
                                </div>
                                <p>{{$comment->description}}</p>
                        </div>
                        @empty
                                <p class="first_comment">Be first to comment!</p>
                        
                        @endforelse
                </div>
                
                
        </div>
</div>
@endsection