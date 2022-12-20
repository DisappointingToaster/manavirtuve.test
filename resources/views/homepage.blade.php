@extends('layout')


@section('content')

<div>
    <div name='promoted_recipes'>
        <div>

            <h1>Promoted recipe 1</h1>

        </div>
        <div>
            <h1>Promoted recipe 2</h1>

            
        </div>
        <div>
            <h1>Promoted recipe 3</h1>

            
        </div>
    </div>

    <div name='recently_viewed'>
        <ul>
            <li>
                Recently viewed recipe 1
            </li>
            <li>
                Recently viewed recipe 2
            </li>
            <li>
                Recently viewed recipe 3
            </li>
        </ul>
    </div>
    
    <div name='recipe_listings'>
        <div name='popular_recipes'>
            <ul>
                <li>
                    Popular recipe 1
                </li>
                <li>
                    Popular recipe 2
                </li>
                <li>
                    Popular recipe 3
                </li>
            </ul>
        </div>
        <div name='new_recipes'>
            <ul>
                <li>
                    New recipe 1
                </li>
                <li>
                    New recipe 2
                </li>
                <li>
                    New recipe 3
                </li>

            </ul>
        </div>
    </div>
</div>
@endsection