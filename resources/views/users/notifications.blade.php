@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Notifications</div>

        <div class="card-body">
            @if ($notifications->count() > 0)
            <ul class="list-group">
                @foreach ($notifications as $notification)
                @if ($notification->type == 'App\Notifications\ReplyAdded')
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            A new reply on <strong>{{ $notification->data['discussion']['title'] }}</strong> discussion
                        </div>
                        <div>
                            <a href="{{ route('discussion.show', $notification->data['discussion']['slug']) }}"
                                class="btn btn-info btn-sm">View Discussion</a>
                        </div>
                    </div>
                </li>
                @endif
                @if ($notification->type == 'App\Notifications\BestReply')
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            Your reply on <strong>{{ $notification->data['discussion']['title'] }}</strong> is <span style="color:green">the best</span>.
                        </div>
                        <div>
                            <a href="{{ route('discussion.show', $notification->data['discussion']['slug']) }}"
                                class="btn btn-info btn-sm">View Discussion</a>
                        </div>
                    </div>
                </li>
                @endif
                @endforeach
            </ul>
            @else
            <div class="text-center">There is not notifications yet.</div>
            @endif
        </div>
    </div>
</div>
@endsection
