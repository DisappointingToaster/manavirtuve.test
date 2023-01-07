@extends('layout')


@section('content')

<div class='modify_filters_container'>
        
        <div class='add_category'>
                <form action="/moderation/newCategory" method="POST">
                        @csrf
                        <div> 
                                <input type="text" name="category_name" placeholder="New category name">
                                <button name="submit" type="submit">Submit</button>
                        </div>
                </form>
        </div>
        <div class='add_category'>
                <form action="/moderation/newIngredient" method="POST">
                        @csrf
                        <div> 
                                <input type="text" name="ingredient_name" placeholder="New ingredient" id="ingredient_name">
                                <select name="categories" id="categories">
                                        @forelse ($ingredient_categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @empty
                                        @endforelse
                                        </select>
                                <button name="submit" type="submit">Submit</button>
                        </div>
                </form>
        </div>
        <div class="">
                @forelse ($ingredient_categories as $category)
                        <form method="POST" action ="/moderation/category/{{$category->id}}">
                                @csrf
                                @method('DELETE')
                                <span><b>{{$category->category_name}}</b></span>
                                <button class="delete_button">Delete</button>
                        </form>    
                    <ul>
                         @forelse ($category->ingredients as $ingredients)
                        <li>
                                <form method="POST" action ="/moderation/ingredient/{{$ingredients->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <span>{{$ingredients->ingredient_name}}</span>
                                        <button class="delete_button">Delete</button>
                                </form>    
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
@endsection