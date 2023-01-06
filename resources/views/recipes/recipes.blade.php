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
        <div class="filter_list">
                @php
                    $type=$ingredients->first()['ingredient_type'];
                    $printed=false;
                @endphp
                    @foreach($ingredients as $ingredient)
                    <div class="category_list">
                    @if($ingredient['ingredient_type']!=$type)
                        @php
                            $printed=false;
                            $type=$ingredient['ingredient_type']
                        @endphp
                    @endif
                    @if($printed==false)
                        <span>{{$type}}</span>
                        @php
                            $printed=true;
                        @endphp
                    @endif
                    
                    <ul> 
                        <li>
                            <div>
                                
                                <input type="checkbox" value="{{$ingredient['ingredient_name']}}">
                                <span> {{$ingredient['ingredient_name']}}</span>
                                
                            </div>
                        </li>
                    </ul>
                </div>
                    @endforeach
                    
                </div>
        
    </div>

    @else
        <div name='filter_list'>
            <span>No ingredients to display</span>
        </div>
    @endif

    <div class='display_box_container'>
        
            @forelse($recipes as $recipe)
            
                <div class='diplay_box'>
                    <img src="{{URL('images/missing.jpg')}}">
                    <a href="/recipes/{{$recipe->id}}">{{$recipe->name}}</a>
                    <span>{{$recipe->tags}}</span>
                    <span>{{$recipe->description}}</span>
                </div>
            @empty
            <p>Sorry, no recipes to display</p>
            @endforelse
    </div>
</div>
@endsection