@if($resource->comments_count > 0)
    <a id="comments"></a>
    <p>{{ trans_choice('comments.count', $resource->comments_count) }}</p>

    @foreach($comments as $comment)
        <div class="row shadow padding margin border">
            <a id="{{ $comment->created_at->format('Y-m-d_h-i-s') }}"></a>
            <div class="col-3">
                <p><strong>{{ $comment->user->name ?? $comment->name }}</strong></p>
                @if ($comment->user_id)
                    <img src="/avatar/{{ $comment->user->avatar }}" class="avatar" style="margin-top: -0.5rem;">
                @endif
            </div>
            @if ($comment->user_id)
                <div class="col-9">{!! $comment->comment !!}</div>
            @else
                <div class="col-9">{{ $comment->comment }}</div>
            @endif
            @auth
                <div class="col flex-right">
                    <a href="{{ route('comments.edit', $comment) }}" class="paper-btn btn-success-outline">Edit</a>
                    <form action="{{route('comments.destroy', $comment)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="paper-btn btn-danger-outline">Delete</button>
                    </form>
                </div>
            @endauth
        </div>
    @endforeach
    {!! $comments->links() !!}
@endif