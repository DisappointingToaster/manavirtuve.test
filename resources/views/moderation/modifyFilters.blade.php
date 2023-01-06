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

</div>
@endsection