@extends('layout')


@section('content')

<div class='register_container'>
    <div class="login_card">
        <h3>Sign up</h3>
        <form action="/users" method="POST">
            @csrf
            <div class="register_username">
                <label for="username">Username:</label>
                <input type="text" name="username" value="{{old('username')}}">
            </div>
            @error('username')
            <p class="login_error">{{$message}}</p>
            @enderror
            <div class="register_email">
                <label for="email">Email:</label>
                <input type="text" name="email" value="{{old('email')}}">
            </div>
            @error('email')
            <p class="login_error">{{$message}}</p>
            @enderror
            <div class="register_password">
                <label for="password">Password:</label>
                <input type="password" name="password">
            </div>
            @error('password')
            <p class="login_error">{{$message}}</p>
            @enderror
            <div class="register_password">
                <label for="password2">Confirm Password:</label>
                <input type="password" name="password_confirmation">
            </div>
            <div class="login_sign">
                <button>Sign up</button>
            </div>
            <div>
                <p>Already have an account?
                <a href="/login">Login</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection