@extends('layout')


@section('content')

<div class="moderation_container">
    <div class="reported">
        <div class="reported_users"> 
            <table>
                <tr>
                    <th>User</th>
                    <th>Reason of report</th>
                    <th>Clear</th>
                </tr>
                @forelse ($reports as $report)
                    <tr>
                        <td><a href="/users/{{$report->user->id}}"> {{$report->user->name}}</a></td>
                        <td>{{$report->reportReason->report_reason}}</td>
                        <td><form action="/report/{{$report->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this report?')">Delete report</button>    
                        </form></td>
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
    @if(auth()->user()->role_id>2)
    <div class="create_new">
        <a href="/moderation/editFilters">Modify Filters</a>
    </div>
    @endif
</div>
@endsection