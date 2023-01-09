@extends('layout')


@section('content')

<div class='login_container'>
    <div class="login_card">
        <h3>Log in</h3>
        <form action="/login" method="POST">
            @csrf
            <div class="login_email">
                <label for="email">Email:</label>
                <input type="text" name="email" value="{{old('email')}}">
                
            </div>
            @error('email')
                <p class="login_error">{{$message}}</p>
                @enderror
            <div class="login_password"> 
                <label for="password">Password:</label>
                <input type="password" name="password">
                
            </div>
            @error('password')
                <p class="login_error">{{$message}}</p>
                @enderror
            <div class="login_sign">
                <button>Sign in</button>
            </div>
            <div class="login_register">
                <p>Don't have an account?
                <a href="/register">Register</a>
                </p>
            </div>
        </form>
        
    </div>
</div>
@endsection