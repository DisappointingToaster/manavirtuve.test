@extends('layout')


@section('content')

<div class="moderation_container">
    <div class="reported">
        <div class="reported_recipes"> 
        <table>
            <tr>
                <th>Recipe</th>
                <th>Reason of report</th>
            </tr>
            <tr>
                <td>Test</td>
                <td>Test reason</td>
            </tr>
        </table>
        </div>
        <div class="reported_users"> 
        
        </div>
    </div>
    <div class="create_new">
        <a href="/moderation/editFilters">Modify Filters</a>
    </div>
</div>
@endsection