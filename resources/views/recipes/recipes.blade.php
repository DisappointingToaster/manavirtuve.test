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
                    <li>
                        <input type="checkbox" value="{{$ingredients->ingredient_name}}">
                        <span>{{$ingredients->ingredient_name}}</span>
                    </li>
                    @empty
                    <p>No ingredients available</p>
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
                    @if($recipe->image_path!="null")
                    <img src="{{asset('images/recipes/'.$recipe->image_path)}}">
                    @else
                    <img src="{{URL('images/missing.jpg')}}">
                    @endif
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