@extends('users.userPage')


@section('userContent')

<div class='user_security_container'>
    <form method="POST" action="/users/{{auth()->user()->id}}/update">
        @csrf
        @method('PUT')
        <label for="email">Email:</label>
        <input name="email" type="text" value="{{auth()->user()->email}}">
        @error('email')
        <p class="email_error">{{$message}}</p>
        @enderror
        <label for="username">Username:</label>
        <input name="username" type="text" value="{{auth()->user()->name}}">
        @error('username')
        <p class="username_error">{{$message}}</p>
        @enderror
        <label for="username">Password:</label>
        <input name="password" type="password" value="">
        @error('password')
        <p class="password_error">{{$message}}</p>
        @enderror
        <label for="username">Confirm password:</label>
        <input name="password_confirmation" type="password" value="">
        <button type="submit">submit</button>
    </form>

</div>
@endsection