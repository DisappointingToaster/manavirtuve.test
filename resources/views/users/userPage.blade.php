@extends('layout')


@section('content')

<div class="profile_container">
    <div class="profile_categories">
        <ul>
            <li><a href="/profile/info">Account Info</a></li>
            <li><a href="/profile/security">Security</a></li>
        </ul>
    </div>
    
    <div class="profile_display"> 
        @yield('userContent')
    </div>
</div>
@endsection