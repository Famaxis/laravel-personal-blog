@if($post->comments->count() > 0)
    <p>Comments: {{ $post->comments()->count() }}</p>
    @foreach($post->comments as $comment)
<div class="row flex-center shadow">
    <p>{{ $comment->user->name ?? $comment->name ?? 'Anon'}}</p>

    @isset ($comment->user->avatar)
        <img src="/avatar/{{ $comment->user->avatar }}" style="max-height:150px; float:left; border-radius:50%; margin-right:25px;">
    @endisset
    <p>{{ $comment->comment }}</p>
</div>
        @endforeach
    @endif