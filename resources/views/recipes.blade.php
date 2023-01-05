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
        @if(count($ingredients)!=0)
        <div name='filter_list'>
                @php
                    $type=$ingredients->first()['ingredient_type'];
                @endphp
            <span>{{$type}}</span>
            
                @foreach($ingredients as $ingredient)
                @if($ingredient['ingredient_type']!=$type)
                    @php
                        $type=$ingredient['ingredient_type']
                    @endphp
                    <span>{{$type}}</span>
                @endif
                <ul> 
                    <li>
                        <div>
                            
                            <input type="checkbox" value="{{$ingredient['ingredient_name']}}">
                            <span> {{$ingredient['ingredient_name']}}</span>
                            
                        </div>
                    </li>
                </ul>
                @endforeach
            
        </div>
    </div>

    @else
        <div name='filter_list'>
            <span>No ingredients to display</span>
        </div>
    @endif

    <div class='display_box_container'>
        
            @for($i=0;$i<9;$i++)
            
                <div class='diplay_box'>
                    <img src="{{URL('images/missing.jpg')}}">
                    <a href='#'>Recipe name</a>
                    <span>Egg, Salt, Bacon</span>
                    <span>Lorem ipsum dolor sit amet, </span>
                </div>
            
            @endfor
        
    </div>

</div>
@endsection