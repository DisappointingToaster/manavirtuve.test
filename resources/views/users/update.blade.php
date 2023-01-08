@extends('users.userPage')


@section('userContent')

<div class='user_security_container'>
    <form method="POST" action="/users/{{auth()->user()->id}}/update">
        @csrf
        @method('PUT')
        <label for="email">Email:</label>
        <input name="email" type="text" value="{{auth()->user()->email}}">
        <label for="username">Username:</label>
        <input name="username" type="text" value="{{auth()->user()->name}}">
        <label for="username">Password:</label>
        <input name="password" type="password" value="">
        <label for="username">Confirm password:</label>
        <input name="password_confirmation" type="password" value="">
        <button type="submit">submit</button>
    </form>
    @if($errors->any())
        <div> 
            <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
        @endif
</div>
@endsection