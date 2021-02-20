@if($resource->comments->count() > 0)
    <a id="comments"></a>
    <p>Comments: {{ $resource->comments()->count() }}</p>

    @foreach($resource->comments as $comment)
        <div class="row flex-right shadow padding margin border">
            <a id="{{ $comment->created_at->format('Y-m-d_h-i-s') }}"></a>
            <div class="col-3">
                <p><strong>{{ $comment->user->name ?? $comment->name }}</strong></p>
                @if ($comment->user_id)
                    <img src="/avatar/{{ $comment->user->avatar }}"
                         style="max-height:150px; float:left; border-radius:50%; margin-right:25px;">
                @endif
            </div>
            @if ($comment->user_id)
                <div class="col-9">{!! $comment->comment !!}</div>
            @else
                <div class="col-9">{{ $comment->comment }}</div>
            @endif
            @auth
                <div class="form-group">
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
@endif