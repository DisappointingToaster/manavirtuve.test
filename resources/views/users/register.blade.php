@extends('layout')


@section('content')

<div class='register'>
    <form action="/users" method="POST">
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" value="{{old('username')}}">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="text" name="email" value="{{old('email')}}">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="password2">Confirm Password:</label>
            <input type="password" name="password_confirmation">
        </div>
        <div>
            <button>Sign up</button>
        </div>
        <div>
            <p>Already have an account?
            <a href="/login">Login</a>
            </p>
        </div>
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