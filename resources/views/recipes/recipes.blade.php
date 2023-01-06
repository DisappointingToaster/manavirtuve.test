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
        @if(count($ingredient_categories)!=0)
        <div class="filter_list">
            @forelse ($ingredient_categories as $category)
                <h5>{{$category->category_name}}</h5>
                <ul> 
                @forelse ($category->ingredients as $ingredients)
                    {{$ingredients->ingredient_name}}
                @empty
                    
                @endforelse
                </ul>
            @empty
                <h5>No ingredients to display</h5>
            @endforelse    
            
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