@extends('layout')


@section('content')

<div>
    <form action="/fridge" method="POST">
        @csrf
    @forelse ($ingredient_categories as $category)
                <h5>{{$category->category_name}}</h5>
                <ul>
                    
                     @forelse ($category->ingredients as $ingredients)
                    <li>
                        <input type="checkbox" value="{{$ingredients->ingredient_name}}" name="ingredient[]">
                        <span>{{$ingredients->ingredient_name}}</span>
                    </li>
                    @empty
                    <p>No ingredients available</p>
                @endforelse
                </ul>
            @empty
                <h5>No ingredients to display</h5>
            @endforelse
            <button type="submit">Submit</button>
    </form>
</div>
@endsection