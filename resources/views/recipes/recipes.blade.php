@extends('layout')


@section('content')

<div class='recipe_browser'>
    <div class='search_box'>
        
        @if(count($ingredient_categories)!=0)
        <div class="filter_list">
            <form>
            
            <input type="text" placeholder="Search your recipe" class="" name="searchName" />
            <button class="submit-button" type="submit">Submit</button>
            @forelse ($ingredient_categories as $category)
                
            <h5>{{$category->category_name}}</h5>
                <ul>
                     @forelse ($category->ingredients as $ingredients)
                        @php
                            $checked=[];
                            if(isset($_GET['category'])){
                                $checked=$_GET['category'];
                            }
                        @endphp
                     <li>
                        <input type="checkbox" value="{{$ingredients->ingredient_name}}" name="category[]"
                        @if(in_array($ingredients->ingredient_name, $checked)) checked @endif
                        
                        >
                        <span>{{$ingredients->ingredient_name}}</span>
                    </li>
                    @empty
                    <p>No ingredients available</p>
                @endforelse
                </ul>
            @empty
                <h5>No ingredients to display</h5>
            @endforelse   
            
            </form>
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
                
                    <img src="{{$recipe->image_path ? asset('images/recipes/'.$recipe->image_path) : asset('images/missing.jpg') }} ">
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