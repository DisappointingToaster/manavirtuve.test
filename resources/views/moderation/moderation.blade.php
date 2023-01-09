@extends('layout')


@section('content')

<div class="moderation_container">
    <div class="reported">
        <div class="reported_users"> 
            <table>
                <tr>
                    <th>User</th>
                    <th>Reason of report</th>
                </tr>
                @forelse ($reports as $report)
                    <tr>
                        <td><a href="/users/{{$report->user->id}}"> {{$report->user->name}}</a></td>
                        <td>{{$report->reportReason->report_reason}}</td>
                    </tr>
                @empty
                <tr>
                    <td>No user reports</td>
                    <td></td>
                </tr>
                @endforelse
                
            </table>
        </div>
    </div>
    <div class="create_new">
        <a href="/moderation/editFilters">Modify Filters</a>
    </div>
</div>
@endsection