@extends('layout')


@section('content')

<div class='single_recipe_display_container'>
        
        <div class='list_ingredients'>
                
                <form action="/recipes/{{$recipe->id}}" method="POST" enctype="multipart/form-data">
                        @php
                                $tags=explode(', ',$recipe->tags);
                        @endphp
                        @csrf
                        @method('PUT');
                        <div class="edit_recipe_fields">
                                <div>
                                        <input type="text" name="recipe_name" placeholder="Your recipe name" value="{{$recipe->name}}">
                                        <textarea name="recipe_description" class="recipe_description">{{$recipe->description}}</textarea>
                                        <input type="file" name="recipe_image" value="{{$recipe->image_path}}">
                                        <button name="submit" type="submit">Submit</button>
                                </div>
                                <div class="listing_box">
                                        @forelse ($ingredient_categories as $category)
                                        <h5>{{$category->category_name}}</h5>
                                        <ul>
                                        @forelse ($category->ingredients as $ingredients)
                                                <li>
                                                        <input type="checkbox" value="{{$ingredients->ingredient_name}}" name="tags[]"
                                                        @if(in_array($ingredients->ingredient_name,$tags))
                                                        checked 
                                                        @endif
                                                        />
                                                        <span>{{$ingredients->ingredient_name}}</span>
                                                </li>
                                        @empty
                                        <p>No ingredients available</p>
                                        @endforelse
                                        </ul>
                                        @empty
                                        <h5>No categories to display</h5>
                                        @endforelse
                                </div>
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