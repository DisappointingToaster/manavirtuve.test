<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mana Virtuve</title>

        

        <!-- Styles -->
        
        <link rel="stylesheet" href="{{URL::asset('css/main.css') }}" />

        
    </head>
    <body class="antialiased">
        <div class="navigation">
            <nav>
                <h2>
                    Mana Virtuve
                </h2>
                <ul class="nav_items">
                    <li ><a href="/">Home</a></li>
                    <li ><a href="/recipes">Recipes</a></li>
                    @auth
                    <li ><a href="/kitchen">My Kitchen</a></li>
                    @if(auth()->user()->role_id>1)
                    <li class="moderation_link"><a href="/moderation">Moderation</a></li>
                    @endif
                    <li ><a href="/profile/info">Profile</a></li>
                    <li class="welcome_message"><span >
                        Welcome {{auth()->user()->name}}</span>
                    </li>
                    <li>
                        <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="logout_button">Logout</button>
                        </form>
                    </li>
                    @else
                    <li ><a href="/register">Register</a></li>
                    <li ><a href="/login">Login</a></li>
                    @endauth
                </ul>
            </nav>  
        </div>
        <main>
            @yield('content')
            <script src="{{URL::asset('js/main.js') }}"></script>
            <script src="//unpkg.com/alpinejs" defer></script>
        </main>
        <x-flashMessage class="flash_message" id="flash_message"/>
    </body>
    <footer>
        
    </footer>
</html>
