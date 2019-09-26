@extends('layouts.app')

@section('content')
<h1>{{ $channel->name }} Channel</h1>
@if ($channel->discussions->count() > 0)
@foreach ($channel->discussions as $dis)
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <img src="{{ Gravatar::src($dis->user->email) }}" width="40px" height="40px" class="rounded-circle">
                <strong>{{ $dis->user->name }}</strong>
            </div>
            <div>
                <a href="{{ route('discussion.show', $dis->slug) }}" class="btn btn-success">View</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $dis->title }}
    </div>
</div>
@endforeach
@else
<div class="card">
    <div class="card-header text-center"></div>
    <div class="card-body">
        There is no discussions yet.
    </div>
</div>
@endif
@endsection
