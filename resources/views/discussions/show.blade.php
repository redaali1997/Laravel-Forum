@extends('layouts.app')

@section('content')
@include('partials.alert')
<div class="card mb-5">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <img src="{{ Gravatar::src($discussion->user->email) }}" width="40px" height="40px"
                    class="rounded-circle">
                <strong>{{ $discussion->user->name }}</strong>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $discussion->title }}
        <hr>
        {!! $discussion->content !!}
        <hr>
        {{-- Best Reply --}}
        <div class="card bg-success" style="color:aliceblue">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img width="40px" height="40px" class="rounded-circle"
                            src="{{ Gravatar::src($discussion->bestReply->user->email) }}" alt="">
                        <strong>{{ $discussion->bestReply->user->name }}</strong>
                    </div>
                    <div>
                        <span class="btn btn-info disabled">Best Reply</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! $discussion->bestReply->content !!}
            </div>
        </div>
    </div>
</div>
{{-- Replies --}}
@foreach ($discussion->replies()->paginate(3) as $reply)
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <img src="{{ Gravatar::src($reply->user->email) }}" width="40px" height="40px" class="rounded-circle">
                <strong>{{ $reply->user->name }}</strong>
            </div>
            @auth
            @if (auth()->user()->id == $discussion->user_id)
            <div>
                <form action="{{ route('best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}"
                    method="post">
                    @csrf
                    <button class="btn btn-info" type="submit" style="color:aliceblue">Mark As Best Reply</button>
                </form>
            </div>
            @endif
            @endauth
        </div>
    </div>
    <div class="card-body">
        {!! $reply->content !!}
    </div>
</div>
@endforeach
{{ $discussion->replies()->paginate(3)->links() }}

{{-- Add A Reply --}}
@auth
<div class="card mt-5">
    <div class="card-header">
        <img src="{{ Gravatar::src(auth()->user()->email) }}" width="40px" height="40px" class="rounded-circle">
        <strong>{{ auth()->user()->name }}</strong>
    </div>
    <div class="card-body">
        <form action="{{ route('replies.store', $discussion->slug) }}" method="post">
            @csrf
            <div class="form-group">
                <input id="content" type="hidden" name="content">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Add Reply</button>
            </div>
        </form>
    </div>
</div>
@endauth
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endsection
