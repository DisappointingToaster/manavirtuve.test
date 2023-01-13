@extends('layout')


@section('content')

<div class="userPage_container">
    <div>
        <div class="user_info"> 
            <h2>User info:</h2>
            <p>Name: {{$userData->name}}</p>
            <p>E-mail: {{$userData->email}}</p>
        </div>
        <div class="user_comments">
            <h3>User comments:<h3>
                @forelse ($userData->comments as $comment)
                <p>{{$comment->description}}</p>
                <a href="/recipes/{{$comment->recipe_id}}">Recipe link</a>
            @empty
                <p>User hasn't commented</p>
            @endforelse
        </div>
    </div>
    <div class="user_prohibit_button">
        <div> 
            <form method="POST" action ="/users/{{$userData->id}}/prohibitComment">
                @csrf
                @method('PUT')
                        @if($userData->can_comment==true)
                                <button class="prohibit_comment_button" name="prohibit_comment_button" value="false">Prevent commenting</button>
                        @else
                                <button class="prohibit_comment_button" name="prohibit_comment_button" value="true">Allow commenting</button>
                        @endif
                </form>
        </div>
        <div> 
            <form method="POST" action ="/users/{{$userData->id}}/prohibitPost">
                @csrf
                @method('PUT')
                        @if($userData->can_post==true)
                                <button class="prohibit_post_button" name="prohibit_post_button" value="false">Prevent posting</button>
                        @else
                                <button class="prohibit_post_button" name="prohibit_post_button" value="true">Allow posting</button>
                        @endif
                </form>
        </div>
    </div>
</div>
@endsection