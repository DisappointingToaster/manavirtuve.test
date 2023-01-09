@extends('layout')


@section('content')

<div class='report_container'>
        <form action="/report" method="POST">
                @csrf
                <input hidden value="{{$user->id}}" name="user">
                <select name="reason" id="reason">
                        @foreach ($report_reasons as $report_reason )
                                <option value="{{$report_reason->id}}" >{{$report_reason->report_reason}}</option>
                        @endforeach
                </select>
                <button type="submit">Submit</button>
        </form>
</div>
@endsection