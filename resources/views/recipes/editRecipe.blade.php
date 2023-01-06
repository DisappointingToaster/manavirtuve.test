@extends('layout')


@section('content')

<div class='single_recipe_display_container'>
        
        <div class='add_recipe'>
                <form action="/recipes" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                                <input type="text" name="recipe_name" placeholder="Your recipe name">
                                <input type="text" name="tags" placeholder="Your recipe tags">
                                <textarea name="recipe_description"></textarea>
                                <input type="file" name="recipe_image">
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