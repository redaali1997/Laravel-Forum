@extends('layouts.app')
@section('content')
@foreach ($discussions as $discussion)
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <img src="{{ Gravatar::src($discussion->user->email) }}" width="40px" height="40px"
                    class="rounded-circle">
                <span><strong>{{ $discussion->user->name }}</strong> posted in
                    <strong>{{ $discussion->channel->name }}</strong> channel</span>
            </div>
            <div>
                <a href="{{ route('discussion.show', $discussion->slug) }}" class="btn btn-success">View</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $discussion->title }}
    </div>
</div>
@endforeach
@endsection
