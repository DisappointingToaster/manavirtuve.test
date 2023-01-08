@extends('users.userPage')


@section('userContent')

<div class='user_info_container'>
    <div >
       <h2>Email:</h2>
       <span>{{auth()->user()->email}}</span> 
       <a href="/profile/update">Update Info</a>
    </div>
</div>
@endsection