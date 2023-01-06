@extends('layout')


@section('content')

<div class='single_recipe_display_container'>
        
        <div class='add_recipe'>
                <form action="/moderation/newCategory" method="POST">
                        @csrf
                        <div> 
                                <input type="text" name="category_name" placeholder="New category name">
                                <button name="submit" type="submit">Submit</button>
                        </div>
                </form>
        </div>    
</div>
@endsection