@extends('layout')


@section('content')

<div>
    <div>
        <div name='search_box'>
            <form role="search">
                <div class="input-group">
                    <input type="search" placeholder="Search your recipe" class=""/>
                    <button class="submit-button" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div>
        <div name='filter_list'>

        </div>
        <div name='diplay_box'>

        </div>
    </div>
</div>
@endsection