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
                    <li ><a href="/fridge">Fridge</a></li>
                    <li ><a href="/kitchen">My Kitchen</a></li>
                    <li class="moderation_link"><a href="/moderation">Moderation</a></li>
                    <li ><a href="/profile/info">Profile</a></li>
                </ul>
            </nav>  
        </div>
        <main>
            @yield('content')

        </main>
    </body>
    <footer>
        
    </footer>
</html>
