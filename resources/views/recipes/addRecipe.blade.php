@extends('layout')


@section('content')

<div class='single_recipe_display_container'>
        
        <div class='list_ingredients'>
                <form action="/recipes" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                                <input class="recipe_name" type="text" name="recipe_name" placeholder="Your recipe name" value="{{old('recipe_name')}}">
                                @forelse ($ingredient_categories as $category)
                                <h5>{{$category->category_name}}</h5>
                                <ul>
                                @forelse ($category->ingredients as $ingredients)
                                        <li>
                                                <input type="checkbox" value="{{$ingredients->ingredient_name}}" name="tags[]">
                                                <span>{{$ingredients->ingredient_name}}</span>
                                        </li>
                                @empty
                                <p>No ingredients available</p>
                                @endforelse
                                </ul>
                                @empty
                                <h5>No categories to display</h5>
                                @endforelse
                                <textarea name="recipe_description" class="recipe_description" placeholder="Your recipe description">{{old('recipe_description')}}</textarea>
                                <input type="file" name="recipe_image" value="{{old('recipe_image')}}">
                                <button name="submit" type="submit">Submit</button>
                        </div>
                </form>
        </div> 
        @if($errors->any())
        <div> 
                <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
        </div>
        @endif
</div>
@endsection