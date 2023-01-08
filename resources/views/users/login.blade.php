@extends('layout')


@section('content')

<div class='register'>
    <form action="/login" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="text" name="email" value="{{old('email')}}">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password">
        </div>
        <div>
            <button>Sign up</button>
        </div>
        <div>
            <p>Don't have an account?
            <a href="/register">Register</a>
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