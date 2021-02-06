@if($post->comments->count() > 0)
    <p>Comments: {{ $post->comments()->count() }}</p>
    @foreach($post->comments as $comment)
        <div class="row flex-right shadow padding margin border">
            <a id="{{ $comment->created_at->format('Y-m-d_h-i-s') }}"></a>
            <div class="col-3">
                <p><strong>{{ $comment->user->name ?? $comment->name }}</strong></p>
                @isset ($comment->user->avatar)
                    <img src="/avatar/{{ $comment->user->avatar }}"
                         style="max-height:150px; float:left; border-radius:50%; margin-right:25px;">
                @endisset
            </div>
            <div class="col-9">{{ $comment->comment }}</div>

            @auth
                <div class="form-group">
                    <a href="{{ route('comments.edit', $comment) }}" class="paper-btn btn-success-outline">Edit</a>
                    <form action="{{route('comments.destroy', $comment)}}"  method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="paper-btn btn-danger-outline">Delete</button>
                    </form>
                </div>

             @endauth

        </div>
    @endforeach
@endif