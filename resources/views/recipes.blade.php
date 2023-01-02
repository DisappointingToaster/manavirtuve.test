@extends('layout')


@section('content')

<div class='recipe_browser'>
    <div class='search_box'>
        <div>
            <form role="search">
                <div class="input-group">
                    <input type="search" placeholder="Search your recipe" class="" value=""/>
                    <button class="submit-button" type="submit">Submit</button>
                </div>
            </form>
        </div>


        <div name='filter_list'>
            <ul>
                <li>
                    <div>
                        <input type="checkbox" value="egg">
                        <span> Egg</span>
                    </div>
                </li>
                <li>
                    <div>
                        <input type="checkbox" value="bread">
                        <span> Bread</span>
                    </div>
                </li>
                <li>
                    <div>
                        <input type="checkbox" value="bacon">
                        <span> Bacon</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class='display_box_container'>
        @for($i=0;$i<9;$i++)
        <div class='diplay_box'>
            <img src="{{URL('images/missing.jpg')}}">
            <span>Recipe Name</span>
            <span>Egg, Salt, Bacon</span>
            <span>Lorem ipsum dolor sit amet, </span>
        </div>
        @endfor
    </div>
</div>
@endsection