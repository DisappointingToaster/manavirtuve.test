<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mana Virtuve</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
        </style>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div>
            <nav >
        
            <ul name="nav-items"style="display: inline;">
                <li ><a href="#">Home</a></li>
                <li ><a href="#">Recipes</a></li>
                <li ><a href="#">Fridge</a></li>
                <li ><a href="#">My Kitchen</a></li>
                <li ><a href="#">Profile</a></li>
            </ul>
        
        </nav>  
    </div>
        <main>
            @yield('content')

        </main>
    </body>
</html>
